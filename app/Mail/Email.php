<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $order,$orderDetails;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$orderDetails)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $id = $this->order->id;
        return $this->subject("Order ODR-$id Checkout Success")->view('email.checkoutConfirmation');
    }
}
