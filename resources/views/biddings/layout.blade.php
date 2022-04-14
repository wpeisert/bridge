<x-bridge-layout>
    <x-slot name="title">Biddings</x-slot>
    <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
    <x-slot name="backButtonRoute">{{ $backButtonRoute ?? 'biddings.index' }}</x-slot>
    {{ $slot }}
</x-bridge-layout>
