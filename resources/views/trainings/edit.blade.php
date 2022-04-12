<x-trainings-layout>

    <x-slot name="subtitle">Edit training</x-slot>

    @include (
        'trainings.form',
        [
            'formAction' => 'update',
            'training' => $training,
            'users' => $users,
            'quizzes' => $quizzes,
        ]
    )

</x-trainings-layout>
