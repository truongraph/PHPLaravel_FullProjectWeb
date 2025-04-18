<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Discount;

class DiscountNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $discount;
    public $name_account;
    /**
     * Create a new message instance.
     */
    public function __construct(Discount $discount, $name_account)
    {
        $this->discount = $discount;
        $this->name_account = $name_account;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Đăng ký tài khoản thành công',
        );
    }

    public function build()
    {
        return $this->view('emails.register_success')
        ->with([
            'discount' => $this->discount,
            'name_account' => $this->name_account,
        ]);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.register_success',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
