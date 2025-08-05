<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResultResource\Pages;
use App\Filament\Resources\ResultResource\RelationManagers;
use App\Models\Result;
use App\Services\ResultService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('exam.name')->label('Exam Name'),
                Tables\Columns\TextColumn::make('exam.level')->label('Exam Level')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('exam.year')->label('Exam Year')->date('M Y')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('User Name'),
                Tables\Columns\TextColumn::make('results')->label('Total Score')->getStateUsing(
                    fn($record, ResultService $resultService) => $resultService->getTotalScore($record->results) . '/' . $resultService->getTotalMaxScore($record->results)
                ),
                Tables\Columns\IconColumn::make('status')
                    ->label('Status')
                    ->alignCenter()
                    ->getStateUsing(
                        fn($record, ResultService $resultService) => $resultService->isPass($record)
                    )
                    ->boolean()
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->tooltip(
                        fn($record, ResultService $resultService) => $resultService->isPass($record) ? 'Passed' : 'Failed'
                    ),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('level')
                // ->
                //     // ->relationship('exam', 'level')
                //     // ->preload()
                //     ->multiple()
                //     ->options([
                //         'N1' => 'N1',
                //         'N2' => 'N2',
                //         'N3' => 'N3',
                //         'N4' => 'N4',
                //         'N5' => 'N5',
                //     ])
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResults::route('/'),
            // 'create' => Pages\CreateResult::route('/create'),
            'view' => Pages\ViewResult::route('/{record}'),
            // 'edit' => Pages\EditResult::route('/{record}/edit'),
        ];
    }
}
