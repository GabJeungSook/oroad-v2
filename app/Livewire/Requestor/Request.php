<?php

namespace App\Livewire\Requestor;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use App\Models\Request as RequestModel;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;


class Request extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(RequestModel::query())
            ->columns([
                TextColumn::make('request_number')
                ->label('Request Number')
                ->copyable()
                ->searchable(),
                // TextColumn::make('user.user_information')
                // ->label('Requested By')
                // ->formatStateUsing(fn ($state) => $state->first_name. ' ' . $state->middle_name. ' ' . $state->last_name)
                // ->searchable(),
                TextColumn::make('total_amount')
                ->label('Total Amount')
                ->formatStateUsing(fn ($state) => '₱' . number_format($state, 2))
                ->searchable(),
                TextColumn::make('documents')
                ->label('Requested Documents')
                ->formatStateUsing(fn ($state) => $state->pivot->quantity . ' ' . $state->title . ' - ₱' . number_format($state->pivot->amount, 2))
                ->listWithLineBreaks()
                ->bulleted(),
                TextColumn::make('purpose')
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->searchable(),
                TextColumn::make('status')->badge()->color('success')->searchable(),
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
                Action::make('edit_request')
                ->label('Edit')
                ->button()
                ->color('warning')
                ->icon('heroicon-o-pencil')
                ->visible(fn ($record) => $record->status === 'Pending'),
                Action::make('view_request')
                ->label('View Request Details')
                ->button()
                ->icon('heroicon-o-eye')
            ])
            ->emptyStateHeading('No request yet')
            ->emptyStateDescription('You can make your first request');;
    }

    public function render()
    {
        return view('livewire.requestor.request');
    }
}
