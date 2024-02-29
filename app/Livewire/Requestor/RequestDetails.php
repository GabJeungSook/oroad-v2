<?php

namespace App\Livewire\Requestor;

use Livewire\Component;

class RequestDetails extends Component
{
    public $record;
    public $full_name;

    public function mount()
    {
        $this->full_name = $this->record->user_information->first_name . ' ' . $this->record->user_information->middle_name . ' ' . $this->record->user_information->last_name;
    }

    public function render()
    {
        return view('livewire.requestor.request-details');
    }
}
