<?php

namespace App\Livewire\Admin;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Support\RawJs;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use App\Models\Document as DocumentModel;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use WireUi\Traits\Actions;

class Document extends Component implements HasForms, HasTable
{
    use Actions;
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(DocumentModel::query())
            ->columns([
                TextColumn::make('title')->searchable(),
                TextColumn::make('amount')
                ->sortable()
                ->badge()
                ->color('warning')
                ->formatStateUsing(fn ($state) => '₱ '.number_format($state, 2)),
            ])->headerActions([
                CreateAction::make()
                ->label('Add Document')
                ->modalHeading('Add Document')
                ->model(DocumentModel::class)
                ->form([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                        TextInput::make('amount')
                        ->prefix('₱')
                        ->mask(RawJs::make('$money($input)'))
                       ->stripCharacters(',')
                       ->required()
                       ->numeric(),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Document added',
                        $description = 'The document was successfully added'
                    );
                })
            ])->actions([
                EditAction::make('edit')
                ->model(DocumentModel::class)
                ->color('success')
                ->form([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255),
                        TextInput::make('amount')
                        ->prefix('₱')
                        ->mask(RawJs::make('$money($input)'))
                       ->stripCharacters(',')
                       ->required()
                       ->numeric(),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Document updated',
                        $description = 'The document was successfully updated'
                    );
                })
            ]);
    }

    public function render()
    {
        return view('livewire.admin.document');
    }
}
