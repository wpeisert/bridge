<x-deal-constraints-layout>

    <x-slot name="subtitle">Create new deal constraints</x-slot>

    @include (
        'deal_constraints.form',
        [
            'formAction' => 'store'
        ]
    )

</x-deal-constraints-layout>
