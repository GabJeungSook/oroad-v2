<?php

namespace App\Livewire\Requestor\Forms;

use Filament\Forms;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\UserType;
use Filament\Forms\Form;
use App\Models\PhilippineCity;
use App\Models\UserInformation;
use App\Models\PhilippineRegion;
use App\Models\PhilippineProvince;
use Filament\Forms\Components\Grid;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\Group;
use Filament\Forms\Get;
use Filament\Notifications\Notification;

class EditUserInformation extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public UserInformation $record;

    public function mount(): void
    {
        $this->record = UserInformation::where('user_id', auth()->user()->id)->first();
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Hidden::make('user_id'),
                    TextInput::make('first_name')
                    ->required(),
                    TextInput::make('middle_name'),
                    TextInput::make('last_name')
                    ->required(),
                    Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female'
                    ])->required(),
                    DatePicker::make('birthday')
                    ->native(false)
                    ->required(),
                    TextInput::make('contact_number')
                    ->prefix('09')
                    ->length(11)
                    ->mask('99 999 9999')
                    ->required(),
                ])->columns(3),
                Section::make('Address')
                ->schema([
                    Select::make('region_code')
                    ->label('Region')
                    ->options(PhilippineRegion::all()->pluck('region_description', 'region_code'))
                    ->preload()
                    ->live()
                    ->required(),
                    Select::make('province_code')
                    ->label('Province')
                    ->options(fn(Get $get) => PhilippineProvince::where('region_code', $this->data['region_code'])->pluck('province_description', 'province_code'))
                    // ->disabled(fn(Get $get) => !$get('region_code'))
                    ->preload()
                    ->live()
                    ->required(),
                    Select::make('city_code')
                    ->label('City / Municipality')
                    ->options(fn($get) => PhilippineCity::where('province_code',  $this->data['province_code'])->pluck('city_municipality_description', 'city_municipality_code'))
                    // ->disabled(fn(Get $get) => !$get('province_code') || !$get('region_code'))
                    ->required(),
                    TextInput::make('postal_code')
                    ->numeric()
                    ->length(4)
                    ->mask('9999')
                    ->required(),
                    Grid::make(1)
                    ->schema([
                        TextInput::make('other_address_details')
                        ->label('Other Details (Barangay, Street, etc.)')
                    ])
                ])->columns(4),
                Section::make('Requestor')
                ->schema([
                    Select::make('campus_id')
                    ->label('Campus')
                    ->preload()
                    ->live()
                    ->options(Campus::all()->pluck('name', 'id'))
                    ->required(),
                    Select::make('course_id')
                    ->label('Course')
                    ->options(fn(Get $get) => Course::where('campus_id', $this->data['campus_id'])->pluck('name', 'id'))
                    ->required(),
                    Select::make('user_type_id')
                    ->label('Requestor Type')
                    ->options(UserType::all()->pluck('name', 'id'))
                    ->required(),
                    Grid::make(1)
                    ->schema([
                        FileUpload::make('valid_id_path')
                        ->uploadingMessage('Uploading valid id...')
                        ->image()
                        ->imageEditor()
                        ->preserveFileNames()
                        ->disk('public')
                        ->directory('valid-ids')
                        ->label('Upload a valid ID')
                        ->required(),
                    ])
                ])->columns(3),
                Toggle::make('has_representative')
                ->live()
                ->label('Do you want to add a representative?'),
                Group::make()
                ->relationship('representative')
                ->schema([
                    Section::make('Representative')
                    ->visible(fn (Get $get) => $get('../has_representative'))
                    ->description('Your representative can claim your requested documents.')
                    ->schema([
                        TextInput::make('representative_first_name')
                        ->label('First Name')
                        ->required(),
                        TextInput::make('representative_middle_name')
                        ->label('Middle Name'),
                        TextInput::make('representative_last_name')
                        ->label('Last Name')
                        ->required(),
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
                    ])->columns(3),
                ]),

                // ...
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
        ->title('Saved Successfully')
        ->body('Your information was updated successfully.')
        ->success()
        ->send();

        redirect()->route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.requestor.forms.edit-user-information');
    }
}
