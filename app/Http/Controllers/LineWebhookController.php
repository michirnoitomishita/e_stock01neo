<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use Illuminate\Support\Facades\Log;
use App\Models\Message;

class LineWebhookController extends Controller
{
    public function message(Request $request) {
        // Log::info('someActionが実行されました。');
        // return response('', 200);
        $data = $request->all();
        $events = $data['events'];
        Log::info($events);
        // $httpClient = new CurlHTTPClient(config('services.line.message.channel_token'));
        // $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.message.channel_secret')]);

        foreach ($events as $event) {
            // メッセージの保存処理
            Message::create([
                'line_user_id' => $event['source']['userId'],
                'line_message_id' => $event['message']['id'],
                'value' => $event['message']['text'],
                'line_message_type' => 'text'
            ]);
            // 自動返信が不要であれば削除
            // $response = $bot->replyText($event['replyToken'], 'メッセージ送信完了');
        }

        // $data = $request->all();
        // $events = $data['events'];
        // $client = new \GuzzleHttp\Client();
        // $config = new \LINE\Clients\MessagingApi\Configuration();
        // $config->setAccessToken(config('services.line.message.channel_token'));
        // $messagingApi = new \LINE\Clients\MessagingApi\Api\MessagingApiApi(
        //  client: $client,
        //  config: $config,
        // );
        // return  response('', 200);
        return;
        // $message = new TextMessage(['type' => 'text','text' => 'hello!']);
        // $request = new ReplyMessageRequest([
        //     'replyToken' => $events['0']['replyToken'],
        //     'messages' => [$message],
        //     ]);
            
//         $response = $messagingApi->replyMessage($request);
        // $httpClient = new CurlHTTPClient(config('services.line.message.channel_token'));
        // $bot = new LINEBot($httpClient, ['channelSecret' => config('services.line.message.channel_secret')]);

        // foreach ($events as $event) {
        //     $response = $bot->replyText($event['replyToken'], 'メッセージ送信完了');
        // }
        // return;
    }
}