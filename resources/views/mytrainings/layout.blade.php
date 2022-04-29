<x-bridge-layout>
    <x-slot name="title">My trainings</x-slot>
    <x-slot name="subtitle">{{ $subtitle ?? '' }}</x-slot>
    <x-slot name="backButtonRoute">{{ $backButtonRoute ?? 'quizzes.index' }}</x-slot>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{!! $message !!}</p>
        </div>
    @endif

    @if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{!! $message !!}</p>
        </div>
    @endif

    {{ $slot }}
</x-bridge-layout>
