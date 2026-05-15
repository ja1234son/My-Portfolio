<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSendController extends Controller
{
    public function homePage()
    {
        return view('welcome');
    }

    public function SendTestMail(Request $request)
    {
        $request->validate([
            'fname' => 'required|string',
            'email' => 'required|email',
            'service' => 'required',
            'message' => 'required|string'
        ]);

        // ✅ FIX: build string properly (no overwrite)
        $emailContent  = "Name: " . $request->fname . "\n";
        $emailContent .= "Email: " . $request->email . "\n";
        $emailContent .= "Service: " . $request->service . "\n";
        $emailContent .= "Message: " . $request->message . "\n";
        $emailContent .= "Sent at: " . now();

        // ✅ FIX: send TO YOU (not client)
        Mail::raw($emailContent, function ($message) use ($request) {
            $message->to('mbaga0345@gmail.com')   // YOU receive it
                    ->subject('New Contact Form - ' . $request->fname)
                    ->replyTo($request->email, $request->fname); // client becomes reply-to
        });

        return back()->with('success', 'Message sent successfully. We’ll be in touch within 24h.');
    }
}