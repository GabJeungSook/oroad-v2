<?php

namespace App\Livewire\Requestor;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Actions\Action;

class RequestedDocument extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $documents;
    public $selectedDocuments = [];
    public $filteredDocuments;
    public $request_number;
    public $total_amount;


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
                dd('test');
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
