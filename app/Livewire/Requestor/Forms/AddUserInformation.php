<?php

namespace App\Livewire\Requestor\Forms;

use Filament\Forms\Get;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Support\RawJs;
use App\Models\PhilippineCity;
use App\Models\PhilippineRegion;
use App\Models\PhilippineProvince;
use App\Models\Campus;
use App\Models\Course;
use App\Models\UserType;
use App\Models\UserInformation;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class AddUserInformation extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
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
                    ->required()
                ])->columns(3),
                    FileUpload::make('valid_id_path')
                    ->uploadingMessage('Uploading receipt image...')
                    ->image()
                    ->preserveFileNames()
                    ->disk('public')
                    ->directory('valid-ids')
                    ->label('Upload a valid ID')
                    ->required(),
                // ...
            ])
            ->statePath('data');
    }

    public function create()
    {
        $this->data['user_id'] = auth()->user()->id;

        UserInformation::create($this->form->getState());

        Notification::make()
        ->title('Saved Successfully')
        ->body('You can now request a document.')
        ->success()
        ->send();

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.requestor.forms.add-user-information');
    }
}
