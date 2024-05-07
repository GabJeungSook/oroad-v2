<?php

namespace App\Livewire\Requestor\Forms;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Actions\Action;
use App\Models\RequestPayment;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use WireUi\Traits\Actions;

class AddPaymentDetails extends Component implements HasForms, HasActions
{
    use Actions;
    use InteractsWithForms;
    use InteractsWithActions;

    public ?array $data = [];
    public $record;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('request_number')
                ->default($this->record->request_number),
                TextInput::make('receipt_number')
                ->label('Receipt Number')
                ->numeric()
                ->required(),
                FileUpload::make('receipt_path')
                ->preserveFileNames()
                ->disk('public')
                ->directory('receipts')
                ->label('Upload Receipt Image')
                ->uploadingMessage('Uploading valid ID...')
                ->image()
                ->required()
                // ...
            ])
            ->statePath('data');
    }

    public function saveAction(): Action
    {
        return Action::make('save')
            ->requiresConfirmation()
            ->action(function () {
                $this->validate();
                $payment = RequestPayment::where('request_number', $this->record->request_number)->first();
                if($payment)
                {
                    Notification::make()
                    ->title('Oops!')
                    ->body('Payment details already exists. Please wait for the admin to verify your payment.')
                    ->danger()
                    ->send();
                    return redirect()->route('dashboard');
                }else{
                    DB::beginTransaction();
                    $this->record->payments()->create($this->form->getState());
                    $this->record->update([
                        'status' => 'Payment Validation',
                    ]);
                    $this->record->activityTimeline()->create([
                        'request_number' => $this->record->request_number,
                        'activity' => 'Payment Validation',
                        'description' => 'Payment details has been added with receipt number: ' . $this->form->getState()['receipt_number'],
                    ]);
                    DB::commit();
                    $this->dialog()->success(
                        $title = 'Saved Successfully',
                        $description = 'Payment details has been added successfully.'
                    );
                    // Notification::make()
                    // ->title('Saved Successfully')
                    // ->body('Payment details has been added successfully.')
                    // ->success()
                    // ->send();
                }
                return redirect()->route('dashboard');
            });
    }

    public function render()
    {
        return view('livewire.requestor.forms.add-payment-details');
    }
}
