<?php

namespace App\Livewire\Requestor\Forms;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class VerifyRequestorEmail extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $verification_code;
    public function mount(): void
    {
        $this->verification_code = session('verification_code');
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('verify_code')
                ->label('Verification Code')
                ->required(),
            ])
            ->statePath('data');
    }

    public function verify()
    {
        if ($this->verification_code === $this->data['verify_code']) {
            session()->forget('verification_code');
            Notification::make()
            ->title('Verification Successful')
            ->body('Your email has been verified successfully. You can now add your information to make a request.')
            ->success()
            ->send();

            // Verification successful
            $user = auth()->user();
            $user->is_verified = 1;  // Directly update the attribute
            $user->save();  // Persist the change to the database

            return redirect()->route('dashboard');
        } else {
            Notification::make()
            ->title('Verification Failed')
            ->body('The verification code you entered is incorrect. Please try again.')
            ->danger()
            ->send();
        }
    }

    public function render()
    {
        return view('livewire.requestor.forms.verify-requestor-email');
    }
}
