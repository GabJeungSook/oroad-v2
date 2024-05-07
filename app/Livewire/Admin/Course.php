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
use WireUi\Traits\Actions;


class Course extends Component implements HasForms, HasTable
{
    use Actions;
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
                ->label('Add Course')
                ->modalHeading('Add Course')
                ->model(CourseModel::class)
                ->form([
                    Select::make('campus_id')
                        ->label('Campus')
                        ->options(CampusModel::all()->pluck('name', 'id'))
                        ->required(),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Course added',
                        $description = 'The course was successfully added'
                    );
                })
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
                ])->successNotification(null)
                ->after(function ($record) {
                    $this->dialog()->success(
                        $title = 'Course updated',
                        $description = 'The course was successfully updated'
                    );
                })
            ]);
    }

    public function render()
    {
        return view('livewire.admin.course');
    }
}
