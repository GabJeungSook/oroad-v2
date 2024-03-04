<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Livewire\Component;
use Filament\Actions\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Actions\ViewAction;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
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
               DB::beginTransaction();
               $this->record->update([
                   'approved_by' => auth()->user()->id,
                   'status' => 'Approved',
                   'remarks' => $data['remarks'],
                   'approved_at' => now(),
               ]);
               $this->record->activityTimeline()->create([
                   'activity' => 'Request Approved',
                   'description' => $data['remarks'] === null ? 'Request Approved by '. auth()->user()->name : 'Request Approved by '. auth()->user()->name . ' with remarks: ' . $data['remarks'],
               ]);
               DB::commit();
               Notification::make()
               ->title('Request Approved')
            //    ->body('An email has been sent to ' . $this->full_name . ' regarding the approval of the request.')
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
                DB::beginTransaction();
                $this->record->update([
                    'approved_by' => auth()->user()->id,
                    'status' => 'Request Denied',
                    'remarks' => $data['remarks'],
                    'denied_at' => now(),
                ]);
                $this->record->activityTimeline()->create([
                    'activity' => 'Request Denied',
                    'description' => 'Request Denied by '. auth()->user()->name . ' with remarks: ' . $data['remarks'],
                ]);
                DB::commit();
                Notification::make()
                ->title('Request Denied')
                // ->body('An email has been sent to ' . $this->full_name . ' regarding the denial of the request.')
                ->success()
                ->send();
                return redirect()->route('admin.pending-request');
            });
    }

    public function approvePaymentAction(): Action
    {
        return Action::make('approvePayment')
            ->label('Approve')
            ->requiresConfirmation()
            ->icon('heroicon-o-check-circle')
            ->form([
                DatePicker::make('date_to_claim')
                ->label('Claim Date')
                ->required()
                ->native(false)
                ->minDate(now())
            ])
            ->modalHeading('Approve Payment Request')
            ->modalDescription('Are you sure you want to approve this payment request? This action cannot be undone.')
            ->modalSubmitActionLabel('Yes, Approve')
            ->modalIcon('heroicon-o-check-circle')
            ->action(function (array $data) {
               DB::beginTransaction();
               $this->record->update([
                   'status' => 'To Claim',
               ]);
                $this->record->payments->update([
                     'approved_by' => auth()->user()->id,
                     'approved_at' => now(),
                     'date_to_claim' => $data['date_to_claim'],
                ]);
                $this->record->activityTimeline()->create([
                    'activity' => 'Payment Request Approved',
                    'description' => 'Payment Request Approved by '. auth()->user()->name . ' with claim date: ' .Carbon::parse($data['date_to_claim'])->format('F d, Y'),
                ]);
               DB::commit();

               Notification::make()
               ->title('Payment Request Approved')
            //    ->body('An email has been sent to ' . $this->full_name . ' regarding the approval of the payment request.')
               ->success()
               ->send();
               return redirect()->route('admin.payment-request');
            });
    }

    public function denyPaymentAction(): Action
    {
        return Action::make('denyPayment')
            ->label('Deny')
            ->color('danger')
            ->requiresConfirmation()
            ->icon('heroicon-o-x-circle')
            ->form([
                Textarea::make('remarks')
                ->label('Remarks')
                ->required()
            ])
            ->modalHeading('Deny Payment Request')
            ->modalDescription('Are you sure you want to deny this payment request? Leave your remarks. This action cannot be undone.')
            ->modalSubmitActionLabel('Yes, Deny')
            ->action(function (array $data) {
               DB::beginTransaction();
               $this->record->update([
                   'status' => 'Payment Request Denied',
               ]);
                $this->record->payments->update([
                     'denied_at' => auth()->user()->id,
                     'remarks' => $data['remarks'],
                ]);
                $this->record->activityTimeline()->create([
                    'activity' => 'Payment Request Denied',
                    'description' => 'Payment Request Denied by '. auth()->user()->name . ' with remarks: ' . $data['remarks'],
                ]);
               DB::commit();

               Notification::make()
               ->title('Payment Request Approved')
            //    ->body('An email has been sent to ' . $this->full_name . ' regarding the denial of the request.')
               ->success()
               ->send();
               return redirect()->route('admin.payment-request');
            });
    }

    public function markAsClaimedAction(): Action
    {
        return Action::make('markAsClaimed')
        ->label('Mark as Claimed')
        ->icon('heroicon-o-check-circle')
        ->requiresConfirmation()
        ->action(function ($record) {
            DB::beginTransaction();
            $this->record->update([
                'status' => 'Claimed',
                'claimed_at' => now(),
            ]);
            $this->record->activityTimeline()->create([
                'activity' => 'Claimed',
                'description' => 'Requested Documents Claimed by '. $this->full_name,
            ]);
            DB::commit();
            Notification::make()
            ->title('Requested Documents Claimed')
            // ->body('An email has been sent to ' . $this->full_name . ' regarding this request.')
            ->success()
            ->send();
            return redirect()->route('admin.request-to-claim');

        });
    }

    public function viewDetailsAction(): Action
    {
        return Action::make('viewDetails')
            ->size(ActionSize::Small)
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
