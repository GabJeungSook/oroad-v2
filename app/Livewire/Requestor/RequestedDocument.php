<?php

namespace App\Livewire\Requestor;

use App\Models\Request;
use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use App\Mail\SubmittedRequestMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
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
    public $request_number;
    public $total_amount;
    public $purpose;


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
                    'purpose' => 'required',
                ],
                [
                    'purpose.required' => 'Fill up your purpose of request.',

                ]);
                DB::beginTransaction();
                $new_request = Request::create([
                    'request_number' => $this->request_number,
                    'user_information_id' => auth()->user()->user_information->id,
                    'purpose' => $this->purpose,
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
                ->body('Your request has been submitted successfully. Please wait for the approval.')
                ->success()
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
    }

    public function render()
    {
        return view('livewire.requestor.requested-document');
    }
}
