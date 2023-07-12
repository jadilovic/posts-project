<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{

    public function createChat($userId) {
        $chat = Chat::create([
            'user1_id' => Auth::id(),
            'user2_id' => $userId
        ]);
        return view('startChatForm', compact('chat'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'chat_id' => 'required',
                'content' => 'required'
            ]);

            Message::create([
                'chat_id' => $request->chat_id,
                'content' => $request->content,
            ]);

            return redirect()->route('chatForm', ['chatId' => $request->chat_id])->with('success', 'Poruka je uspjesno poslana');
        } catch (\Throwable $th) {
            return redirect()->route('myPosts')->with('error', 'Poruka nije poslana');
        }
    }

    public function openChat($chatId) {
        try {
            $chat = Chat::findOrFail($chatId);
            return view('chatForm', compact('chat'));
        } catch (\Throwable $th) {
            return redirect()->route('myPosts')->with('error', 'Poruka nije poslana');
        }
    }

    public function getMyChats() {
        // $chats = Chat::whereUserId(Auth::id())->get();
        // return view('myChats', compact('chats'));
    }
}
