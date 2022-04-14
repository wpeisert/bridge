<x-trainings-layout>

    <x-slot name="subtitle">Show training (ID: {{ $training->id }})</x-slot>

    @include (
        'trainings.form',
        [
            'training' => $training,
            'users' => $users,
            'quizzes' => $quizzes,
        ]
    )

</x-trainings-layout>
