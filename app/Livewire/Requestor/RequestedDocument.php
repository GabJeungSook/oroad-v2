<?php

namespace App\Livewire\Requestor;

use App\Models\Purpose;
use App\Models\Request;
use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Mail\SubmittedRequestMail;
use App\Models\UserRepresentative;
use Filament\Actions\CreateAction;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class RequestedDocument extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $documents;
    public $selectedDocuments = [];
    public $filteredDocuments;
    public $selectedReceiver = '';
    public $receiver_name;
    public $request_number;
    public $total_amount;
    public $purposes;
    public $selected_purpose;
    public $other_purpose;

    public function updatedSelectedReceiver()
    {
        // This method is called whenever the `selectedRadio` property is updated
        // You can perform actions based on the selected value (e.g., show/hide additional fields)
        if ($this->selectedReceiver === 'me') {
            $this->receiver_name = auth()->user()->user_information->fullName();
        } else if ($this->selectedReceiver === 'representative') {
            $this->receiver_name = auth()->user()->user_information->representative?->fullName();
        }
    }

    public function addRepresentativeAction(): Action
    {
        return CreateAction::make('addRepresentative')
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_information_id'] = auth()->user()->user_information->id;
                return $data;
            })
            ->label('Add Representative')
            ->modalHeading('Add Representative')
            ->form([
                Grid::make(3)
                ->schema([
                    TextInput::make('representative_first_name')
                    ->label('First Name')->required(),
                    TextInput::make('representative_middle_name')
                    ->label('Middle Name'),
                    TextInput::make('representative_last_name')
                    ->label('Last Name')->required(),
                ]),
                Grid::make(1)
                ->schema([
                    FileUpload::make('representative_valid_id_path')
                    ->uploadingMessage('Uploading valid id...')
                    ->image()
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('valid-ids')
                    ->label('Upload a valid ID for your representative')
                    ->required(),
                ])
            ])
            ->after(function () {
                Notification::make()
                ->title('Representative Added Successfully')
                ->body('Your representative has been added successfully. You can now select your representative as the receiver.')
                ->success()
                ->send();
                $this->selectedReceiver === 'representative';
                $this->receiver_name = auth()->user()->user_information->representative?->fullName();

            })
            ->successNotification(null)
            ->createAnother(false)
            ->model(UserRepresentative::class);
    }

    public function updateRepresentativeAction(): Action
    {
        return EditAction::make('updateRepresentative')
        ->size(ActionSize::Small)
        ->label('Update Representative')
        ->record(UserRepresentative::where('user_information_id', auth()->user()->user_information->id)->first())
        ->modalHeading('Update Representative')
        ->form([
            Grid::make(3)
            ->schema([
                TextInput::make('representative_first_name')
                ->label('First Name')->required(),
                TextInput::make('representative_middle_name')
                ->label('Middle Name'),
                TextInput::make('representative_last_name')
                ->label('Last Name')->required(),
            ]),
            Grid::make(1)
            ->schema([
                FileUpload::make('representative_valid_id_path')
                ->uploadingMessage('Uploading valid id...')
                ->image()
                ->preserveFileNames()
                ->disk('public')
                ->directory('valid-ids')
                ->label('Upload a valid ID for your representative')
                ->required(),
            ])
            ])->after(function () {
                Notification::make()
                ->title('Representative Added Updated')
                ->success()
                ->send();
                $this->selectedReceiver === 'representative';
                $this->receiver_name = auth()->user()->user_information->representative?->fullName();

            })->successNotification(null);
    }


    public function document_selected($id, $amount)
    {
        $newDocument = [
            'id' => $id,
            'quantity' => '1',
            'authentication' => '0',
            'amount' => $amount
        ];

        if (in_array($id, array_column($this->selectedDocuments, 'id'))) {
            $key = array_search($id, array_column($this->selectedDocuments, 'id'));
            unset($this->selectedDocuments[$key]);
            $this->selectedDocuments = array_values($this->selectedDocuments);
        } else {
            array_push($this->selectedDocuments, $newDocument);
        }
             // Extracting selected document IDs
            $selectedDocumentIds = array_column($this->selectedDocuments, 'id');


              // Fetching documents based on selected IDs with custom sort order
        if (!empty($selectedDocumentIds)) {
            $this->filteredDocuments = Document::whereIn('id', $selectedDocumentIds)
                                            ->orderByRaw("FIELD(id, " . implode(',', $selectedDocumentIds) . ")")
                                            ->get();
        } else {
            // If no documents are selected, set filteredDocuments to an empty array
            $this->filteredDocuments = [];
        }
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->requiresConfirmation()
            ->label('Submit Request')
            ->action(function ()
            {
                $total = 0;

                foreach ($this->selectedDocuments as $key => $document) {
                    $total += $document['amount'] * $document['quantity'];
                }

                $this->validate([
                    'selected_purpose' => 'required',
                ],
                [
                    'selected_purpose.required' => 'Select a purpose for your request.',

                ]);
                DB::beginTransaction();
                $new_request = Request::create([
                    'request_number' => $this->request_number,
                    'user_information_id' => auth()->user()->user_information->id,
                    'purpose_id' => $this->selected_purpose,
                    'other_purpose' => $this->other_purpose === null ? null : $this->other_purpose,
                    'has_representative' => $this->selectedReceiver === 'representative' ? 1 : 0,
                    'total_amount' => $total,
                    'status' => 'Pending',
                ]);

                foreach($this->selectedDocuments as $document)
                {
                    $new_request->documents()->attach($document['id'], [
                        'request_id' => $new_request->id,
                        'request_code' => $this->request_number,
                        'quantity' => $document['quantity'],
                        'is_authenticated' => $document['authentication'],
                        'amount' => $document['amount'] * $document['quantity'],
                    ]);
                }
                    $new_request->activityTimeline()->create([
                        'request_number' => $this->request_number,
                        'activity' => 'Submitted',
                        'description' => 'Request has been submitted by ' . auth()->user()->name. ' with code ' . $this->request_number,
                    ]);
                DB::commit();

                //for email sending - to be updated upon approval
                // Mail::to(auth()->user()->email)->send(new SubmittedRequestMail($new_request));

                Notification::make()
                ->title('Request Submitted Successfully')
                ->body('Your request shall undergo validation and you will be notified through your email.')
                ->success()
                ->persistent()
                ->send();

                return redirect()->route('dashboard');
            });
    }

    public function test()
    {
        dd($this->selectedDocuments);
    }

    public function mount()
    {
        $this->documents = Document::all();
        $this->request_number = 'SKSU-' . now()->format('u') . '-' . Str::random(8);
        $this->selectedReceiver = 'me';
        $this->receiver_name = auth()->user()->user_information->fullName();
        $this->purposes = Purpose::all();
    }

    public function render()
    {
        return view('livewire.requestor.requested-document');
    }
}
