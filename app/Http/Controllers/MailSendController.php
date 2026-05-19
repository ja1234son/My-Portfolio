<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function SendTestMail(Request $request)
{
    $request->validate([
        'fname' => 'required|string',
        'email' => 'required|email',
        'service' => 'required',
        'message' => 'required|string'
    ]);

    $emailContent  = "Name: " . $request->fname . "\n";
    $emailContent .= "Email: " . $request->email . "\n";
    $emailContent .= "Service: " . $request->service . "\n";
    $emailContent .= "Message: " . $request->message . "\n";
    $emailContent .= "Sent at: " . now();

    dispatch(function () use ($request, $emailContent) {
        Mail::raw($emailContent, function ($message) use ($request) {
            $message->to('mbaga0345@gmail.com')
                ->subject('New Contact Form - ' . $request->fname)
                ->replyTo($request->email, $request->fname);
        });
    });

    return back()->with('success', 'Message sent successfully. We’ll be in touch within 24h.');
}
}