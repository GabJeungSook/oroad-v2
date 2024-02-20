<?php

namespace App\Livewire\Admin;

use App\Models\UserType as UserTypeModel;
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

class UserType extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(UserTypeModel::query())
            ->columns([
                TextColumn::make('name')->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->model(UserTypeModel::class)
                ->form([
                    TextInput::make('name')
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
        return view('livewire.admin.user-type');
    }
}
