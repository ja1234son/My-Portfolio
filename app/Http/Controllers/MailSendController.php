<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactEmail;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;

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

        SendContactEmail::dispatch($request->all());

         return back()->with('success', 'Message sent successfully. We\'ll be in touch within 24h.');

    }
}