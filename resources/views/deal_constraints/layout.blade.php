<x-bridge-layout>
    <x-slot name="title">Deal constraints</x-slot>
    <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
    <x-slot name="backButtonRoute">{{ $backButtonRoute ?? 'deal_constraints.index' }}</x-slot>
    {{ $slot }}
</x-bridge-layout>
