<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;
use App\Models\User;

class EmailController extends Controller
{
    public static function sendEmailReminder($id) {

    	$user = User::findOrFail($id);

        Mail::send('emails.reminder', ['user' => $user], function ($message) use ($user) {
            
            $message->from('feyza.kozan04@gmail.com', 'HODA');

            $message->to($user->email, $user->name)->subject('We miss you');
        });
		
        return response()->json(['message' => 'Request completed']);
    }
}
