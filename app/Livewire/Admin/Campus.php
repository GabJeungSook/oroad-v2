<?php

namespace App\Livewire\Admin;

use App\Models\Campus as CampusModel;
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
use Filament\Forms\Components\Textarea;

class Campus extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CampusModel::query())
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('address')->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->model(CampusModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextArea::make('address')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([
                EditAction::make('edit')
                ->model(CampusModel::class)
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextArea::make('address')
                        ->required()
                        ->maxLength(255),
                ])
            ]);
    }

    public function render()
    {
        return view('livewire.admin.campus');
    }
}
