<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Filament\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ReviewPendingRequest extends Component implements  HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;
    public $full_name;

    public function mount()
    {
        $this->full_name = $this->record->user_information->first_name . ' '
        . $this->record->user_information->middle_name . ' '
        . $this->record->user_information->last_name;
    }

    public function approveAction(): Action
    {
        return Action::make('approve')
            ->requiresConfirmation()
            ->icon('heroicon-o-check-circle')
            ->form([
                Textarea::make('remarks')
                ->label('Remarks')
            ])
            ->modalHeading('Approve Request')
            ->modalDescription('Are you sure you want to approve this request? This action cannot be undone.')
            ->modalSubmitActionLabel('Yes, Approve')
            ->modalIcon('heroicon-o-check-circle')
            ->action(function (array $data) {
               $this->record->update([
                   'approved_by' => auth()->user()->id,
                   'status' => 'Approved',
                   'remarks' => $data['remarks'],
                   'approved_at' => now(),
               ]);
               Notification::make()
               ->title('Request Approved')
               ->body('An email has been sent to ' . $this->full_name . ' regarding the approval of the request.')
               ->success()
               ->send();
               return redirect()->route('admin.pending-request');
            });
    }

    public function denyAction(): Action
    {
        return Action::make('deny')
            ->requiresConfirmation()
            ->color('danger')
            ->icon('heroicon-o-x-circle')
            ->form([
                Textarea::make('remarks')
                ->label('Remarks')
                ->required()
            ])
            ->modalHeading('Deny Request')
            ->modalDescription('Are you sure you want to deny this request? Leave your remarks. This action cannot be undone.')
            ->modalSubmitActionLabel('Yes, Deny')
            ->action(function (array $data) {
                $this->record->update([
                    'approved_by' => auth()->user()->id,
                    'status' => 'Approved',
                    'remarks' => $data['remarks'],
                    'denied_at' => now(),
                ]);
                Notification::make()
                ->title('Request Denied')
                ->body('An email has been sent to ' . $this->full_name . ' regarding the denial of the request.')
                ->success()
                ->send();
                return redirect()->route('admin.pending-request');
            });
    }

    public function viewDetailsAction(): Action
    {
        return Action::make('viewDetails')
            ->color('secondary')
            ->icon('heroicon-o-eye')
            ->modalHeading('Requestor Details')
            ->modalContent(fn (): View => view(
                'admin.requestor-details',
                ['record' => $this->record->user_information],
            ))->modalSubmitAction(false)->modalCancelActionLabel('Close')
            ->slideOver();
    }

    public function render()
    {
        return view('livewire.admin.review-pending-request');
    }
}
