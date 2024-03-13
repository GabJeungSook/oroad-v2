<?php

namespace App\Livewire\Admin;


use App\Models\Purpose as PurposeModel;
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

class Purpose extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(PurposeModel::query())
            ->columns([
                TextColumn::make('name')->label('Description')->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->model(PurposeModel::class)
                ->label('Add Purpose')
                ->modalHeading('Add Purpose')
                ->form([
                    TextInput::make('name')
                        ->label('Description')
                        ->required()
                        ->maxLength(255),
                ])
            ])->actions([
                EditAction::make('edit')
                ->model(PurposeModel::class)
                ->form([
                    TextInput::make('name')
                        ->label('Description')
                        ->required()
                        ->maxLength(255),
                ])
            ]);
    }

    public function render()
    {
        return view('livewire.admin.purpose');
    }
}
