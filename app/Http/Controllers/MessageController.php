<?php

namespace App\Http\Controllers;

use App\Models\message;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    public function index()
    {
        return message::with('user')->latest()->get();
    }

    public function store(Request $request)
    {
        $request->validate(['message' => 'required']);

        $message = Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json($message);
    }
}
