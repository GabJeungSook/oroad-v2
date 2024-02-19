<?php

namespace App\Livewire\Requestor;

use Livewire\Component;
use App\Models\Document;
use Illuminate\Support\Str;

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
