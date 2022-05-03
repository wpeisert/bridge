<x-biddings-layout>
    <x-slot name="subtitle">Show bidding (ID: {{ $bidding->id }})</x-slot>

@include (
    'biddings.bidding_content',
    [
        'bidding' => $bidding,
        'type' => 'show',
    ]
)

</x-biddings-layout>
