<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

// 追加のuse宣言
use App\Services\LineBotService as LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class MessageController extends Controller
{
    public function index(Request $request) {
        $lineUsers = Message::groupBy('line_user_id')->get('line_user_id');
        return view('message.index', ['lineUsers' => $lineUsers]);
    }

    public function show(Request $request) {
        $messages = Message::where('line_user_id', $request->lineUserId)->get();
        return view('message.show', ['lineUserId' => $request->lineUserId, 'messages' => $messages]);
    }
 // 新しいcreateアクション
    public function create(Request $request) {
        Message::create([
            'line_user_id' => $request->lineUserId,
            'text' => $request->message,
        ]);

        $httpClient = new CurlHTTPClient(config('services.line.message.channel_token'));
        $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.message.channel_secret')]);

        $textMessageBuilder = new TextMessageBuilder($request->message);
        $response = $bot->pushMessage($request->lineUserId, $textMessageBuilder);

        return redirect(route('message.show', ['lineUserId' => $request->lineUserId]));
    }
}