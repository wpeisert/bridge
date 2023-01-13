<?php

namespace App\Mail;

use App\Models\Bidding;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BidExpectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Bidding $bidding, private bool $admin = false) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(($this->admin ? '[ADM] ' : '') . view('emails.bid_expected.subject')->with(['bidding' =>
                    $this->bidding]))
            ->view('emails.bid_expected.html')->with(['bidding' => $this->bidding]);
    }
}
