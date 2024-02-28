<?php

namespace App\Livewire\Admin;


use App\Models\User as UserModel;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

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
                ->model(UserTypeModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([
                EditAction::make('edit')
                ->model(UserTypeModel::class)
                ->form([
                    TextInput::make('name')
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
