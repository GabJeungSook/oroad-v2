<?php

namespace App\Livewire\Requestor\Forms;

use App\Models\Request;
use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Notifications\Notification;

class EditRequest extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;
    public $documents;
    public $selectedDocuments = [];
    public $filteredDocuments;
    public $request_number;
    public $total_amount;
    public $purpose;
    public $selected_ids;

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

    public function editAction(): Action
    {
        return Action::make('edit')
            ->requiresConfirmation()
            ->label('Edit Request')
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
                //update
                $this->record->update([
                    'purpose' => $this->purpose,
                    'total_amount' => $total,
                ]);
                foreach ($this->selectedDocuments as $key => $document) {
                    $this->record->documents()->updateExistingPivot($document['id'], [
                        'quantity' => $document['quantity'],
                        'is_authenticated' => $document['authentication'],
                        'amount' => $document['amount'] * $document['quantity']
                    ]);
                }
                // $this->record->documents()->sync($this->selectedDocuments);
                DB::commit();

                Notification::make()
                ->title('Request Submitted Successfully')
                ->body('Your request has been submitted successfully. Please wait for the approval.')
                ->success()
                ->send();

                return redirect()->route('dashboard');
            });
    }

    public function mount()
    {
        $this->documents = Document::all();

        $selectedDocs = $this->record->documents->toArray();

        foreach($selectedDocs as $selectedDoc)
        {
            $newDocument = [
                'id' => $selectedDoc['id'],
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
        $this->purpose = $this->record->purpose;
    }

    public function render()
    {
        return view('livewire.requestor.forms.edit-request');
    }
}
