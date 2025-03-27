<?php

namespace App\Http\Controllers;

use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendTestEmail()
    {
        // Mail::to('recipient@example.com')->send(new TestMail());
        return 'Email sent!';
    }
    
}
