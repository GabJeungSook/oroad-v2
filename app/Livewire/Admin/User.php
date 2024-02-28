<?php

namespace App\Livewire\Admin;


use Filament\Tables;
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
            ->query(UserModel::query()->where('role_id', 3))
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->label('New Staff')
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
                        ->maxLength(255)
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
                ])
            ]);
    }

    public function render()
    {
        return view('livewire.admin.user');
    }
}
