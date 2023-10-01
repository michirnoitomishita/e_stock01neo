<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Services\LineBotService as LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;

class MessageController extends Controller
{
    // LINEユーザーIDごとの一覧を表示するアクション
    public function indexByLineUserId(Request $request) {
        $lineUsers = Message::groupBy('line_user_id')->get('line_user_id');
        return view('message.index_by_line_user_id', ['lineUsers' => $lineUsers]);
    }

    public function show( $request) {
       
        $messages = Message::where('id', $request)->first();
    
        return view('messages.show', ['messages' => $messages]);
    }

    public function create(Request $request) {
        Message::create([
            'line_user_id' => $request->lineUserId,
            'value' => $request->message,
        ]);

        $httpClient = new CurlHTTPClient(config('services.line.message.channel_token'));
        $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.message.channel_secret')]);

        $textMessageBuilder = new TextMessageBuilder($request->message);
        $response = $bot->pushMessage($request->lineUserId, $textMessageBuilder);

        return redirect(route('messages.show', ['lineUserId' => $request->lineUserId]));
    }

    // 全てのメッセージの一覧を表示するアクション
    public function index() {
        $messages = Message::orderBy('created_at', 'desc')->get();
        return view('messages.index', compact('messages'));
    }
    
    public function destroy($id)
{
    $message = Message::find($id);
    if ($message) {
        $message->delete();
        return redirect()->route('message.index')->with('success', 'Message deleted successfully');
    } else {
        return redirect()->route('message.index')->with('error', 'Message not found');
    }
}

    
}
