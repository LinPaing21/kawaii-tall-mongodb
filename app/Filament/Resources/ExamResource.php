<?php

namespace App\Filament\Resources;

use App\Models\Exam;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\ExamResource\Pages;
use App\Filament\Resources\ExamResource\Traits\ExamSection;

class ExamResource extends Resource
{
    protected static ?string $model = Exam::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Name'),
                TextInput::make('level')
                    ->required()
                    ->label('Level'),
                DatePicker::make('year')
                    ->native(false)
                    ->displayFormat('Y-m-d')
                    ->required()
                    ->label('Year'),
                TextInput::make('path')
                    ->label('Path')
                    ->required(fn (string $context): bool => $context === 'create')
                    ->suffixAction(
                        Action::make('generateExamSections')
                            ->icon('heroicon-m-document-arrow-down')
                            ->tooltip('Generate Exam Sections')
                            ->action('generateExamSections')
                    ),
                Textarea::make('description')
                    ->label('Description'),
                FileUpload::make('audio_file')
                    ->label('Audio File')
                    ->required(fn (string $context): bool => $context === 'create')
                    ->directory('JLPT/audio')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['audio/mpeg', 'audio/mp3'])
                    ->disk('s3'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Name'),
                Tables\Columns\TextColumn::make('level')->label('Level')->sortable(),
                Tables\Columns\TextColumn::make('year')->label('Year')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->label('Description')
                    ->limit(40),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('active')
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('level')
                    ->multiple()
                    ->options([
                        'N1' => 'N1',
                        'N2'    => 'N2',
                        'N3'    => 'N3',
                        'N4'    => 'N4',
                        'N5'    => 'N5',
                    ])
            ])
            ->defaultSort('year', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExams::route('/'),
            'create' => Pages\CreateExam::route('/create'),
            'edit' => Pages\EditExam::route('/{record}/edit'),
        ];
    }
}
