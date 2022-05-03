<x-biddings-layout>
    <x-slot name="subtitle">Edit bidding (ID: {{ $bidding->id }})</x-slot>

@include (
    'biddings.bidding_content',
    [
        'bidding' => $bidding,
        'type' => 'edit',
    ]
)

</x-biddings-layout>
