<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use App\Models\Request as RequestModel;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ApproveRequest extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(RequestModel::query()->where('status', 'Approved')->orderBy('created_at', 'desc'))
            ->columns([
                TextColumn::make('request_number')
                ->label('Request Code')
                ->copyable()
                ->searchable(),
                TextColumn::make('user_information')
                ->label('Name')
                ->formatStateUsing(fn ($state) => $state->first_name. ' ' . $state->middle_name. ' ' . $state->last_name)
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('user_information', function($query) use ($search){
                        $query->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
                    });
                }),
                TextColumn::make('created_at')
                ->label('Date Requested')
                ->formatStateUsing(fn ($state) => $state->format('F d, Y h:i A'))
                ->searchable(),
                TextColumn::make('approved_at')
                ->label('Date Approved')
                ->formatStateUsing(fn ($state) => Carbon::parse($state)->format('F d, Y h:i A'))
                ->searchable(),
                TextColumn::make('purpose.name')
                ->formatStateUsing(fn ($state) => ucwords($state))
                ->wrap()
                ->searchable(),
            ])
            ->headerActions([
                //
            ])->actions([
                ActionGroup::make([
                    Action::make('review_request')
                    ->label('Review Request')
                    ->color('warning')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => route('admin.review-pending-request', $record)),
                    ViewAction::make('view_request_form')
                    ->label('Request Form')
                    ->color('secondary')
                    ->icon('heroicon-o-document-text')
                    ->modalContent(fn (RequestModel $record): View => view(
                        'requestor.request-details',
                        ['record' => $record],
                    )),
                    ViewAction::make('view_timeline')
                    ->label('Track Progress')
                    ->color('secondary')
                    ->icon('heroicon-o-queue-list')
                    ->modalContent(fn (RequestModel $record): View => view(
                        'requestor.request-timeline',
                        ['record' => $record],
                    ))
                ])->icon('heroicon-s-bolt')

                // ActionGroup::make([
                // Action::make('edit_request')
                // ->label('Edit')
                // ->color('warning')
                // ->icon('heroicon-o-pencil')
                // ->visible(fn ($record) => $record->status === 'Pending')
                // ->url(fn ($record) => route('requestor.edit-request', $record)),
                // Action::make('view_request')
                // ->label('View Request Details')
                // ->color('success')
                // ->icon('heroicon-o-eye')
                // ->url(fn ($record) => route('requestor.view-request', $record)),
                // ]),
            ])
            ->emptyStateHeading('No request yet')
            ->emptyStateDescription('All approved requests will be displayed here');;
    }

    public function render()
    {
        return view('livewire.admin.approve-request');
    }
}
