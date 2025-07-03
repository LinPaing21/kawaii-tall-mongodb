<?php

namespace App\Filament\Resources\ExamResource\Pages;

use Arr;
use OpenAI\Client;

use Filament\Actions\Action;

use Illuminate\Support\Facades\Storage;
use App\Filament\Resources\ExamResource;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ExamResource\Traits\ExamSection;

class CreateExam extends CreateRecord
{
    use ExamSection;
    protected static string $resource = ExamResource::class;

    protected static string $view = 'filament.resources.exam-resource.pages.create-exam';

    public array $examSections = [];
    protected function getFormActions(): array
    {
        return [
            Action::make('create')->action('create')->label('Create')->disabled(empty($this->data['exam_sections']))
                ->icon('heroicon-o-check-circle'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->data['audio_url'] = Storage::disk('s3')->url(reset($this->data['audio_file']));
        $this->data['active'] = false;
        return Arr::except($this->data, ['audio_file']);
    }
}
