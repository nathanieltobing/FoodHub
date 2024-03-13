<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $order,$orderDetails,$vendor,$type,$status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$orderDetails,$vendor,$type)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->vendor = $vendor;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(strcmp($this->type,"checkout") == 0){
            $id = $this->order->id;
            return $this->subject("Order ODR-$id Checkout Success")->view('email.checkoutConfirmation');
        }
        else if(strcmp($this->type,"registration") == 0){
            return $this->subject("Foodhub Registration Success")->view('email.registerSuccess');
        }
        else if(strcmp($this->type,"incoming order") == 0){
            return $this->subject("Incoming Order Foodhub")->view('email.incomingOrder');
        }
        else if(strcmp($this->type,"order status updated") == 0){
            $status = $this->order->status;
            return $this->subject("Order ODR-$id is $status")->view('email.orderUpdated');
        }
    }
}
