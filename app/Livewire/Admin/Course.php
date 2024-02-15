<?php

namespace App\Livewire\Admin;

use App\Models\Course as CourseModel;
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
use Filament\Forms\Components\Select;


class Course extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CourseModel::query())
            ->columns([
                TextColumn::make('campus.name')->searchable(),
                TextColumn::make('name')->searchable(),
            ])->headerActions([
                CreateAction::make()
                ->model(CourseModel::class)
                ->form([
                    Select::make('campus_id')
                        ->options(CampusModel::all()->pluck('name', 'id'))
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])->extraAttributes(['style' => 'background-color: #4F46E5; color: white; border-color: #4F46E5;'])
            ]) ->actions([
                EditAction::make('edit')
                ->model(CourseModel::class)

                ->form([
                    Select::make('campus_id')
                    ->options(CampusModel::all()->pluck('name', 'id'))
                    ->required(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])
            ]);
    }

    public function render()
    {
        return view('livewire.admin.course');
    }
}
