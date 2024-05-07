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
use WireUi\Traits\Actions;

class Campus extends Component implements HasForms, HasTable
{
    use Actions;
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
                ->label('Add Campus')
                ->modalHeading('Add Campus')
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextArea::make('address')
                        ->required()
                        ->maxLength(255),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Campus added',
                        $description = 'The campus was successfully added'
                    );
                })
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
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Campus updated',
                        $description = 'The campus was successfully updated'
                    );
                })
            ]);
    }

    public function render()
    {
        return view('livewire.admin.campus');
    }
}
