<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order; // Data to be passed to the email template

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Order Confirmation')
            ->view('order_confirmation'); 
    }
}















?>