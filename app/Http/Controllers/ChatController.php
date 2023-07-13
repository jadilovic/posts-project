<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
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
                'content' => 'required',
            ]);

            Message::create([
                'chat_id' => $request->chat_id,
                'content' => $request->content,
                'user_id' => Auth::id()
            ]);

            return redirect()->route('chatForm', ['chatId' => $request->chat_id])->with('success', 'Poruka je uspjesno poslana');
        } catch (\Throwable $th) {
            return redirect()->route('myPosts')->with('error', 'Poruka nije poslana');
        }
    }

    public function openChat($chatId) {
        try {
            $chat = Chat::findOrFail($chatId);
            $userName1 = User::findOrFail($chat->user1_id)->name;
            $userName2 = User::findOrFail($chat->user2_id)->name;
            return view('chatForm', compact('chat', 'userName1', 'userName2'));
        } catch (\Throwable $th) {
            return redirect()->route('myPosts')->with('error', 'Poruka nije poslana');
        }
    }

    public function getMyChats() {
        $chats = Chat::where('user1_id', Auth::id())->OrWhere('user2_id', Auth::id())->get();
        return view('myChats', compact('chats'));
    }
}
