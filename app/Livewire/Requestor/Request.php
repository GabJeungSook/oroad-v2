<?php

namespace App\Livewire\Requestor;

use App\Models\Request as RequestModel;
use Livewire\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;


class Request extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(RequestModel::query())
            ->columns([
                TextColumn::make('request_number')->searchable(),
                TextColumn::make('user.user_information.first_name')->searchable(),
                TextColumn::make('user.user_information.middle_name')->searchable(),
                TextColumn::make('user.user_information.last_name')->searchable(),
                TextColumn::make('purpose')->searchable(),
                TextColumn::make('status')->searchable(),
            ])
            ->headerActions([
                // CreateAction::make()
                // ->model(CampusModel::class)
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextArea::make('address')
                //         ->required()
                //         ->maxLength(255),
                // ])->extraAttributes(['style' => 'background-color: #4F46E5; color: white; border-color: #4F46E5;'])
            ])->actions([
                // EditAction::make('edit')
                // ->model(CampusModel::class)
                // ->form([
                //     TextInput::make('name')
                //         ->required()
                //         ->maxLength(255),
                //     TextArea::make('address')
                //         ->required()
                //         ->maxLength(255),
                // ])
            ])
            ->emptyStateHeading('No request yet')
            ->emptyStateDescription('You can make your first request');;
    }

    public function render()
    {
        return view('livewire.requestor.request');
    }
}
