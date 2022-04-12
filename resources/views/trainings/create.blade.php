<x-trainings-layout>

    <x-slot name="subtitle">Create new training</x-slot>

    @include (
        'trainings.form',
        [
            'formAction' => 'store',
            'users' => $users,
            'quizzes' => $quizzes,
        ]
    )

</x-trainings-layout>
