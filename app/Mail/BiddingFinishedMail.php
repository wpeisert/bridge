<?php

namespace App\Mail;

use App\Models\Bidding;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BiddingFinishedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Bidding $bidding, private User $user) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(view('emails.bidding_finished.subject')->with(['bidding' => $this->bidding]))
            ->view('emails.bidding_finished.html')->with(['bidding' => $this->bidding, 'user' => $this->user]);
    }
}
