<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
// use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class SendContactEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
         $emailContent = "Name: " . $this->data['fname'] . "\n";
        $emailContent .= "Email: " . $this->data['email'] . "\n";
        $emailContent .= "Service: " . $this->data['service'] . "\n";
        $emailContent .= "Message: " . $this->data['message'] . "\n";
        $emailContent .= "Sent at: " . now();

        Mail::raw($emailContent, function ($message) {
            $message->to('mbaga0345@gmail.com')
                    ->subject('New Contact Form - ' . $this->data['fname'])
                    ->replyTo($this->data['email'], $this->data['fname']);
        });
    }
}