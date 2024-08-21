<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messages()
    {
        $user = auth()->user();
        $messages = Message::with('user')->latest()->get();
        return view('messages', [
            'user' => $user,
            'messages' => $messages,
        ]);
    }


    public function message(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
        ]);


        $message = Message::create([
            'user_id' => auth()->id(),
            'text' => $request->input('text'),
        ]);
        SendMessage::dispatch($message);
        return back()->with('success', 'Message sent successfully.');
    }

}
