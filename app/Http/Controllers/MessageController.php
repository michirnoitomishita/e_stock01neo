<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Services\LineBotService as LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use App\Models\Record;
use LINE\Clients\MessagingApi\Model\TextMessage;
use LINE\Clients\MessagingApi\Model\PushMessageRequest;
use Illuminate\Support\Facades\Http;


class MessageController extends Controller
{
    // LINEユーザーIDごとの一覧を表示するアクション
    public function indexByLineUserId(Request $request) {
        $lineUsers = Message::groupBy('line_user_id')->get('line_user_id');
        return view('message.index_by_line_user_id', ['lineUsers' => $lineUsers]);
    }

   public function show($id) {
    $messages = Message::where('id', $id)->first();
    return view('messages.show', ['messages' => $messages]);
}


   public function create(Request $request, $id) {
    //   dd($id);
    // records テーブルからデータを取得
    $record = Record::find($id);
    if (!$record) {
        return redirect()->back()->with('error', 'Record not found');
    }


    $client = new \GuzzleHttp\Client();
    $config = new \LINE\Clients\MessagingApi\Configuration();
    $config->setAccessToken('<fcE6g0rlcKZ43aZwJH588WnHy+etr43wfFOSayNxH9zYOcKJF6pybQUvhSP4wevoJc9t2VS/OnHOaprRK5O2X3vqk4Ruh/O0nnYMae+wsaOZaWPQDBo9+2kDQx1BURc5G+bKg9mZcIlvaA3QNvHQoQdB04t89/1O/w1cDnyilFU=>');
    $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
      client: $client,
      config: $config,
    );
    
    $responseContent = "Date: " . $record->record_date . "\n";
    $responseContent .= "Time of Day: " . $record->time_of_day . "\n";
    $responseContent .= "Content: " . $record->content . "\n";
    $responseContent .= "Protein: " . $record->protein . "\n";
    $responseContent .= "Lipid: " . $record->lipid . "\n";
    $responseContent .= "Vitamin: " . $record->vitamin . "\n";
    $responseContent .= "Carbohydrate: " . $record->carbohydrate . "\n";
    $responseContent .= "Mineral: " . $record->mineral . "\n";
    
        $response = Http::withHeaders([
        'Content-Type' => 'application/json',
        'Authorization' => 'Bearer fcE6g0rlcKZ43aZwJH588WnHy+etr43wfFOSayNxH9zYOcKJF6pybQUvhSP4wevoJc9t2VS/OnHOaprRK5O2X3vqk4Ruh/O0nnYMae+wsaOZaWPQDBo9+2kDQx1BURc5G+bKg9mZcIlvaA3QNvHQoQdB04t89/1O/w1cDnyilFU='
    ])->post('https://api.line.me/v2/bot/message/push', [
        'to' => $record->line_user_id,
        'messages' =>[['type'=>'text','text'=>$responseContent]]
    ]);
    // dd($response);
    
   if ($response->successful()) {
        return redirect()->route('message-sent'); // この行を変更
    } else {
        return redirect(route('messages.show', ['id' => $id]))->with('error', 'Failed to send message');
    }

    
    // $message = new TextMessage(['type' => 'text','text' => 'hello!']);
    // $push = new PushMessageRequest(['to' => 'Uf0a5451e2bf12feea8f290de235e29ac', 'messages' => 'messages', 'notificationDisabled' => false, 'customAggregationUnits' => 'customAggregationUnits']);
    // dd($push);
    // メッセージの作成
    // Message::create([
    //     'line_user_id' => $record->line_user_id,
    //     'value' => $record->content, // HTMLフォームから message 値を取得
    //     'line_message_id' => 1,
    //     'line_message_type' => 'text',
    // ]);

    // LINEBot のインスタンス作成

    // LINE に送るメッセージを組み立てる
    
    // ... 他のカラムに関する情報も追加 ...

    // $textMessageBuilder = new TextMessageBuilder($responseContent);
    // $response = $bot->pushMessage($record->line_user_id, $textMessageBuilder); // LINEユーザーIDを指定

    // return redirect(route('messages.show', ['id' => $id]));
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

    // public function sendMessage(Request $request) {
    //     $lineUserId = $request->input('line_user_id');
        
    //     // Recordモデルから対応するデータを取得
    //     $record = Record::where('line_user_id', $lineUserId)->first();
    //     if (!$record) {
    //         return redirect()->back()->with('error', 'Record not found');
    //     }

    //     // LINEBot のインスタンス作成
    //     $httpClient = new CurlHTTPClient(config('services.line.message.channel_token'));
    //     $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.message.channel_secret')]);

    //     // LINE に送るメッセージを組み立てる
    //     $responseContent = "Date: " . $record->record_date . "\n";
    //     $responseContent .= "Time of Day: " . $record->time_of_day . "\n";
    //     $responseContent .= "Content: " . $record->content . "\n";
    //     // 他のカラムに関する情報も追加できます...

    //     $textMessageBuilder = new TextMessageBuilder($responseContent);
    //     $response = $bot->pushMessage($lineUserId, $textMessageBuilder);

    //     // 成功/失敗に応じてリダイレクト
    //     if ($response->isSucceeded()) {
    //         return redirect()->back()->with('success', 'Message sent successfully');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to send message');
    //     }
    // }
    
    
}
