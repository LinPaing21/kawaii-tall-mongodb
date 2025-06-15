<?php

namespace App\Filament\Resources\ExamResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\ExamResource;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ExamResource\Traits\ExamSection;

class EditExam extends EditRecord
{
    use ExamSection;

    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.edit-exam';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($this->data['audio_file'])) {
            $this->data['audio_url'] = Storage::disk('s3')->url(reset($this->data['audio_file']));
        }
        return \Arr::except($this->data, ['id', 'created_at', 'updated_at', 'audio_file']);
    }
}
