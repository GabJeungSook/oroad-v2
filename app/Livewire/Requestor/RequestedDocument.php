<?php

namespace App\Livewire\Requestor;

use Livewire\Component;
use App\Models\Document;

class RequestedDocument extends Component
{
    public $documents;
    public $selectedDocuments = [];
    public $filteredDocuments;
    public $request_number;


    public function document_selected($id)
    {
        if (in_array($id, $this->selectedDocuments)) {
            $key = array_search($id, $this->selectedDocuments);
            unset($this->selectedDocuments[$key]);

        } else {
            array_push($this->selectedDocuments, $id);
        }
        $this->filteredDocuments =  Document::whereIn('id', $this->selectedDocuments)->get();
    }

    public function mount()
    {
        $this->documents = Document::all();
        $this->request_number = 'SKSU-'.now()->format('ymd').'-'.now()->format('hisu');
    }

    public function render()
    {
        return view('livewire.requestor.requested-document');
    }
}
