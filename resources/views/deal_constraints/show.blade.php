<x-deal-constraints-layout>

    <x-slot name="subtitle">Show deal constraints (ID: {{ $dealConstraint->id }})</x-slot>

    @include (
        'deal_constraints.form',
        [
            'dealConstraint' => $dealConstraint,
        ]
    )

</x-deal-constraints-layout>
