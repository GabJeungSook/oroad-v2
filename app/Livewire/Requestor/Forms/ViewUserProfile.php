<?php

namespace App\Livewire\Requestor\Forms;

use Livewire\Component;
use Filament\Actions\Action;
use App\Models\UserInformation;
use Filament\Actions\EditAction;
use App\Models\UserRepresentative;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Contracts\HasForms;
use Filament\Support\Enums\ActionSize;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use WireUi\Traits\Actions;

class ViewUserProfile extends Component implements  HasForms, HasActions
{
    use Actions;

    use InteractsWithActions;
    use InteractsWithForms;

    public $record;

    public function updateUserAction(): Action
    {
        return Action::make('updateUser')
            ->label('Update Information')
            ->requiresConfirmation()
            ->icon('heroicon-o-user')
            ->url(fn (): string => route('requestor.update-user-information'));
    }

    public function addRepresentativeAction(): Action
    {
        return CreateAction::make('addRepresentative')
            ->icon('heroicon-o-user-plus')
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_information_id'] = auth()->user()->user_information->id;
                return $data;
            })
            ->label('Add Representative')
            ->modalHeading('Add Representative')
            ->form([
                Grid::make(3)
                ->schema([
                    TextInput::make('representative_first_name')
                    ->label('First Name')->required(),
                    TextInput::make('representative_middle_name')
                    ->label('Middle Name'),
                    TextInput::make('representative_last_name')
                    ->label('Last Name')->required(),
                ]),
                Grid::make(1)
                ->schema([
                    FileUpload::make('representative_valid_id_path')
                    ->uploadingMessage('Uploading valid id...')
                    ->image()
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('valid-ids')
                    ->label('Upload a valid ID for your representative')
                    ->required(),
                ])
            ])
            ->after(function () {
                $this->dialog()->success(
                    $title = 'Representative Added Successfully',
                    $description = 'Your representative has been added successfully. You can now select your representative as the receiver.'
                );

                // Notification::make()
                // ->title('Representative Added Successfully')
                // ->body('Your representative has been added successfully. You can now select your representative as the receiver.')
                // ->success()
                // ->send();

                return redirect()->route('requestor.view-user-profile');

            })
            ->successNotification(null)
            ->createAnother(false)
            ->model(UserRepresentative::class);
    }

    public function updateRepresentativeAction(): Action
    {
        return EditAction::make('updateRepresentative')
        ->icon('heroicon-o-user')
        ->size(ActionSize::Small)
        ->label('Update Representative')
        ->record(UserRepresentative::where('user_information_id', auth()->user()->user_information->id)->first())
        ->modalHeading('Update Representative')
        ->form([
            Grid::make(3)
            ->schema([
                TextInput::make('representative_first_name')
                ->label('First Name')->required(),
                TextInput::make('representative_middle_name')
                ->label('Middle Name'),
                TextInput::make('representative_last_name')
                ->label('Last Name')->required(),
            ]),
            Grid::make(1)
            ->schema([
                FileUpload::make('representative_valid_id_path')
                ->uploadingMessage('Uploading valid id...')
                ->image()
                ->preserveFileNames()
                ->disk('public')
                ->directory('valid-ids')
                ->label('Upload a valid ID for your representative')
                ->required(),
            ])
            ])->after(function () {
                $this->dialog()->success(
                    $title = 'Representative Updated',
                    $description = ''
                );
                // Notification::make()
                // ->title('Representative Added Updated')
                // ->success()
                // ->send();

                return redirect()->route('requestor.view-user-profile');

            })->successNotification(null);
    }

    public function uploadClearanceAction(): Action
    {
        return EditAction::make('uploadClearance')
            ->record($this->record)
            ->label('Upload')
            ->link()
            ->modalHeading('Upload Clearance')
            ->icon('heroicon-o-arrow-up-on-square')
            ->form([
                Grid::make(1)
                ->schema([
                    FileUpload::make('campus_clearance_path')
                    ->uploadingMessage('Uploading campus clearance...')
                    ->image()
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('campus-clearances')
                    ->label('Campus Clearance')
                    ->required(),
                ])
                ])->successNotification(null)
                ->after(function () {
                    $this->dialog()->success(
                        $title = 'Campus Clearance Uploaded',
                        $description = ''
                    );
                });
    }

    public function updateClearanceAction(): Action
    {
        return EditAction::make('updateClearance')
            ->record($this->record)
            ->label('Update')
            ->color('warning')
            ->link()
            ->modalHeading('Update Clearance')
            ->icon('heroicon-o-pencil')
            ->form([
                Grid::make(1)
                ->schema([
                    FileUpload::make('campus_clearance_path')
                    ->uploadingMessage('Uploading campus clearance...')
                    ->image()
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('campus-clearances')
                    ->label('Campus Clearance')
                    ->required(),
                ])
                ])->successNotification(null)
                ->after(function () {
                    $this->dialog()->success(
                        $title = 'Campus Clearance Updated',
                        $description = ''
                    );
                });
    }

    public function mount()
    {
        $this->record = UserInformation::where('user_id', auth()->user()->id)->first();
    }
    public function render()
    {
        return view('livewire.requestor.forms.view-user-profile');
    }
}
