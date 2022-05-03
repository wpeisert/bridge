<x-deal-constraints-layout>

    <x-slot name="subtitle">Show deal constraints (ID: {{ $dealConstraint->id }})</x-slot>

    <form>
        <fieldset disabled="disabled">
            @include ('deal_constraints.form_fields', ['dealConstraint' => $dealConstraint])
        </fieldset>
    </form>

</x-deal-constraints-layout>
