<?php

namespace App\Mail;

use App\Models\Bidding;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminBiddingFinishedMail extends Mailable
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
            ->subject(view('emails.bidding_finished.admin_subject')->with(['bidding' => $this->bidding]))
            ->view('emails.bidding_finished.admin_html')->with(['bidding' => $this->bidding]);
    }
}
