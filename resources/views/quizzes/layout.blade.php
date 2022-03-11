<x-bridge-layout>
    <x-slot name="title">Quizzes</x-slot>
    <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
    <x-slot name="backButtonRoute">{{ $backButtonRoute ?? 'quizzes.index' }}</x-slot>
    {{ $slot }}
</x-bridge-layout>
