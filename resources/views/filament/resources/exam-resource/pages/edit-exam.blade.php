<x-filament-panels::page>
    @session('error')
        <x-filament-panels.alert type="error">
            {{ session('error') }}
        </x-filament-panels.alert>
    @endsession

    <x-filament-panels::form wire:submit="save">
        {{ $this->form }}

        @if (empty($data['exam_sections']))
            <div class="mb-1 text-sm text-red-300 rounded-lg" role="alert">
                ** Please generate Exam Sections first. **
            </div>
        @else
            <livewire:filament.exam-section-modifier wire:model="data.exam_sections" />

            <x-filament-panels::form.actions
                :actions="$this->getFormActions()"
                :full-width="$this->hasFullWidthFormActions()"
            />
        @endif
    </x-filament-panels::form>
</x-filament-panels::page>
