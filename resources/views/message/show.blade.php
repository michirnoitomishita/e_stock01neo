<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LINEメッセージ</title>
    </head>
    <body class="antialiased">
      <div>
        LINEユーザーID {{ $lineUserId }}
      </div>
      <ul>
      @foreach($messages as $message)
        <li>
          LINEメッセージ {{ $message->text }}
        </li>
      @endforeach
      </ul>
      <form method="post" action="{{ route('message.create', ['lineUserId' => $lineUserId]) }}">
        @csrf
        <input type="text" name="message">
        <button type="submit">送信</button>
      </form>
    </body>
</html>