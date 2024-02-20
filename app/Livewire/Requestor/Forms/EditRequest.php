<?php

namespace App\Livewire\Requestor\Forms;

use Livewire\Component;

class EditRequest extends Component
{
    public $record;

    public function render()
    {
        return view('livewire.requestor.forms.edit-request');
    }
}
