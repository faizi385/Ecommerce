<?php

// app/Http/Controllers/TestEmailController.php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmed; // Use the appropriate mailable class
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class TestEmailController extends Controller
{
    public function sendTestEmail()
    {
        $order = (object) [
            'id' => 123,
            'total' => 99.99,
            'status' => 'approved',
            'created_at' => now(),
            'user' => (object) [
                'name' => 'John Doe',
                'email' => 'test@example.com',
            ],
        ];

        Mail::to('test@example.com')->send(new OrderConfirmed($order));

        return 'Test email sent!';
    }
}
