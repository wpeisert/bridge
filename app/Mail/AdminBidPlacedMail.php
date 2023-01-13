<?php

namespace App\Mail;

use App\Models\Bidding;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminBidPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Bidding $bidding) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(view('emails.bid_placed.admin_subject')->with(['bidding' => $this->bidding]))
            ->view('emails.bid_placed.admin_html')->with(['bidding' => $this->bidding]);
    }
}
