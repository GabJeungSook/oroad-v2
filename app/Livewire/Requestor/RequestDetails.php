<?php

namespace App\Livewire\Requestor;

use App\Models\Request;
use Livewire\Component;
use Filament\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Actions\ViewAction;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class RequestDetails extends Component implements  HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;
    public $full_name;

    public function mount()
    {
        $this->full_name = $this->record->user_information->first_name . ' ' . $this->record->user_information->middle_name . ' ' . $this->record->user_information->last_name;
    }

    public function viewTimelineAction(): Action
    {
        return  Action::make('viewTimeline')
        ->label('Activity Timeline')
        ->color('secondary')
        ->icon('heroicon-o-clock')
        ->modalContent(fn (): View => view(
            'requestor.request-timeline',
            ['record' => $this->record],
        ))->modalSubmitAction(false)->modalCancelActionLabel('Close')
        ->slideOver();
    }

    public function render()
    {
        return view('livewire.requestor.request-details');
    }
}
