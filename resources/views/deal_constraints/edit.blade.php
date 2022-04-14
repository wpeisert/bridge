<x-deal-constraints-layout>

    <x-slot name="subtitle">Edit deal constraints (ID: {{ $dealConstraint->id }})</x-slot>

    @include (
        'deal_constraints.form',
        [
            'formAction' => 'update',
            'dealConstraint' => $dealConstraint,
        ]
    )

</x-deal-constraints-layout>
