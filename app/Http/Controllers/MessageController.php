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
        $userId = Auth::id();

        return Message::with(['sender', 'receiver'])
        ->where(function ($query) use ($userId) {
            $query->where('user_id', $userId) 
                  ->orWhere('receiver_id', $userId); 
        });
        }

        public function store(Request $request)
        {
            $request->validate([
                'message' => 'required',
                'receiver_id' => 'required|exists:users,id', 
            ]);
        
            $message = Message::create([
                'user_id' => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message' => $request->message,
            ]);
        
            return response()->json($message);
        }
}
