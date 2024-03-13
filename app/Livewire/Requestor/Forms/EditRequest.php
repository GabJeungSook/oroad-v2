<?php

namespace App\Livewire\Requestor\Forms;

use App\Models\Purpose;
use App\Models\Request;
use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use App\Models\UserRepresentative;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class EditRequest extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;
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
    public $selected_ids;

    public function document_selected($id, $amount)
    {
        $newDocument = [
            'id' => $id,
            'request_code' => $this->record->request_number,
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
        $this->total_amount = array_sum(array_column($this->selectedDocuments, 'amount'));
    }

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

    public function editAction(): Action
    {
        return Action::make('edit')
            ->requiresConfirmation()
            ->label('Edit Request')
            ->action(function ()
            {
                $total = 0;

                foreach ($this->selectedDocuments as $key => $document) {
                    $total += $document['amount'];
                }

                $this->validate([
                    'selected_purpose' => 'required',
                ],
                [
                    'selected_purpose.required' => 'Select a purpose for your request.',

                ]);
                DB::beginTransaction();
                $this->record->update([
                    'purpose_id' => $this->selected_purpose,
                    'other_purpose' => $this->other_purpose === null ? null : $this->other_purpose,
                    'has_representative' => $this->selectedReceiver === 'representative' ? 1 : 0,
                    'total_amount' => $total,
                ]);
                // dd($this->selectedDocuments);
                $this->record->documents()->sync($this->fetchDocumentPivotData());
                DB::commit();
                Notification::make()
                ->title('Request Updated')
                ->body('Your request has been updated successfully. You cannot edit once it is approved.')
                ->success()
                ->send();
                // return redirect()->route('requestor.view-request', $this->record);
                return redirect()->route('dashboard');
            });
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

    public function updatedSelectedDocuments()
    {
        foreach ($this->selectedDocuments as $key => $document) {
            $this->selectedDocuments[$key]['amount'] = Document::find($document['id'])->amount * $document['quantity'];
        }
    }

    public function fetchDocumentPivotData()
    {
        $data = [];

        foreach ($this->selectedDocuments as $document) {
            $data[$document['id']] = [
                'request_code' => $this->record->request_number,
                'quantity' => $document['quantity'],
                'is_authenticated' => $document['authentication'],
                'amount' => $document['amount']
            ];
        }

        return $data;
    }


    public function mount()
    {
        $this->documents = Document::all();

        $selectedDocs = $this->record->documents->toArray();

        foreach($selectedDocs as $selectedDoc)
        {
            $newDocument = [
                'id' => $selectedDoc['id'],
                'request_code' => $this->record->request_number,
                'quantity' => $selectedDoc['pivot']['quantity'],
                'authentication' => $selectedDoc['pivot']['is_authenticated'],
                'amount' => $selectedDoc['pivot']['amount']
            ];
            array_push($this->selectedDocuments, $newDocument);
        }
        $selectedDocumentIds = array_column($this->selectedDocuments, 'id');
        $this->filteredDocuments = Document::whereIn('id', $selectedDocumentIds)
        ->orderByRaw("FIELD(id, " . implode(',', $selectedDocumentIds) . ")")
        ->get();

        $this->selected_ids = $selectedDocumentIds;
        $this->request_number = $this->record->request_number;
        $this->total_amount = $this->record->total_amount;

        if($this->record->has_representative)
        {
            $this->selectedReceiver = 'representative';
            $this->receiver_name = auth()->user()->user_information->representative?->fullName();
        }else{
            $this->selectedReceiver = 'me';
            $this->receiver_name = auth()->user()->user_information->fullName();
        }

        if($this->record->purpose_id === 7)
        {
            $this->selected_purpose = "7";
            $this->other_purpose = $this->record->other_purpose;
        }else{
            $this->other_purpose = null;
            $this->selected_purpose = $this->record->purpose_id;
        }
        $this->purposes = Purpose::all();
    }

    public function render()
    {
        return view('livewire.requestor.forms.edit-request');
    }
}
