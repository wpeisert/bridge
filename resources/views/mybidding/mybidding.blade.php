@include (
    'biddings.bidding',
    [
        'bidding' => $bidding,
        'edit' => true,
        'buttonText' => 'Next',
        'buttonRoute' => route('mybidding.next', $bidding->id)
    ]
)
