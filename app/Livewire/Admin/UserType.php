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
use WireUi\Traits\Actions;

class UserType extends Component implements HasForms, HasTable
{
    use Actions;
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
                ->label('Add Type')
                ->modalHeading('Add User Type')
                ->model(UserTypeModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'User type added',
                        $description = 'The user type was successfully added'
                    );
                })
            ])->actions([
                EditAction::make('edit')
                ->model(UserTypeModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'User type updated',
                        $description = 'The user type was successfully updated'
                    );
                })
            ]);
    }


    public function render()
    {
        return view('livewire.admin.user-type');
    }
}
