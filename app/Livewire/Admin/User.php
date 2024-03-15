<?php

namespace App\Livewire\Admin;


use App\Models\Role;
use Filament\Tables;
use App\Models\Campus;
use Filament\Forms\Get;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\User as UserModel;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class User extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No staff yet')
            ->emptyStateDescription('Add a new staff')
            ->query(UserModel::query()->whereIn('role_id', [3, 4]))
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role.name')->label('Assignment')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'REGISTRAR' => 'success',
                    'CASHIER' => 'warning',
                })
                ->sortable()->searchable(),
                TextColumn::make('campus.name')->label('Campus')->sortable()->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->label('Add Staff')
                ->modalHeading('Add Staff')
                ->model(UserModel::class)
                ->form([
                    Hidden::make('role_id')
                        ->default(3)
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('password')
                        ->password()
                        ->required()
                        ->confirmed()
                        ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->password()
                        ->required()
                        ->maxLength(255),
                    Select::make('role_id')
                        ->live()
                        ->label('Assignment')
                         ->options(Role::whereNotIn('name', ['ADMIN','REQUESTOR'])->pluck('name', 'id'))->required(),
                    Select::make('campus_id')
                        ->label('Campus')
                        ->options(function (Get $get) {
                            $role = $get('role_id');
                           return Campus::whereDoesntHave('user', function($query) use ($role) {
                            $query->where('role_id', $role);
                           })->pluck('name', 'id');
                        })->required(),
                ])
            ])->actions([
                EditAction::make('edit')
                ->model(UserModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                    Select::make('role_id')
                        ->live()
                        ->label('Assignment')
                         ->options(Role::whereNotIn('name', ['ADMIN','REQUESTOR'])->pluck('name', 'id'))->required(),
                    Select::make('campus_id')
                        ->label('Campus')
                        ->options(function (Get $get) {
                            $role = $get('role_id');
                           return Campus::whereDoesntHave('user', function($query) use ($role) {
                            $query->where('role_id', $role);
                           })->pluck('name', 'id');
                        })->required(),
                ])
            ]);
    }

    public function render()
    {
        return view('livewire.admin.user');
    }
}
