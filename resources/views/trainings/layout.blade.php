<x-bridge-layout>
    <x-slot name="title">Trainings</x-slot>
    <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
    <x-slot name="backButtonRoute">{{ $backButtonRoute ?? 'trainings.index' }}</x-slot>
    {{ $slot }}
</x-bridge-layout>
