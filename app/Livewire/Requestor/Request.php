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
use Filament\Tables\Actions\ActionGroup;
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
            ->poll('5s')
            ->query(RequestModel::query()->where('user_information_id', auth()->user()->user_information->id)->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('request_number')
                ->label('Request Number')
                ->copyable()
                ->searchable(),
                // TextColumn::make('user.user_information')
                // ->label('Requested By')
                // ->formatStateUsing(fn ($state) => $state->first_name. ' ' . $state->middle_name. ' ' . $state->last_name)
                // ->searchable(),
                TextColumn::make('documents')
                ->label('Requested Documents')
                ->formatStateUsing(function ($state){
                    if($state->pivot->is_authenticated)
                    {
                        return $state->pivot->quantity . ' ' . $state->title . ' (w/ authentication)'.' - ₱' . number_format($state->pivot->amount, 2);
                    }else{
                        return $state->pivot->quantity . ' ' . $state->title . ' - ₱' . number_format($state->pivot->amount, 2);
                    }
                })
                ->listWithLineBreaks()
                ->bulleted(),
                TextColumn::make('purpose.name')
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->wrap()
                ->searchable(),
                TextColumn::make('total_amount')
                ->label('Total Amount')
                ->formatStateUsing(fn ($state) => '₱' . number_format($state, 2))
                ->searchable(),
                TextColumn::make('created_at')
                ->label('Date Requested')
                ->formatStateUsing(fn ($state) => $state->format('F d, Y h:i A'))
                ->searchable(),
                TextColumn::make('status')->badge()->color('success')->searchable(),
            ])
            ->headerActions([
                //
            ])->actions([
                ActionGroup::make([
                Action::make('edit_request')
                ->label('Edit')
                ->color('warning')
                ->icon('heroicon-o-pencil')
                ->visible(fn ($record) => $record->status === 'Pending')
                ->url(fn ($record) => route('requestor.edit-request', $record)),
                Action::make('request_details')
                ->label('Request Details')
                ->color('secondary')
                ->icon('heroicon-o-bars-3-bottom-left')
                ->url(fn ($record) => route('request-view-detail', $record)),
                Action::make('view_request')
                ->label('View Request Form')
                ->color('success')
                ->icon('heroicon-o-document-text')
                ->url(fn ($record) => route('requestor.view-request', $record))
                ->visible(fn ($record) => $record->status === 'Approved'),
                Action::make('add_payment')
                ->label('Add Payment Details')
                ->color('warning')
                ->icon('heroicon-o-credit-card')
                ->url(fn ($record) => route('add-payment-details', $record))
                ->visible(fn ($record) => $record->status === 'Approved'),
                ]),
            ])
            ->emptyStateHeading('No request yet')
            ->emptyStateDescription('You can make your first request');;
    }

    public function render()
    {
        return view('livewire.requestor.request');
    }
}
