<!-- resources/views/message-sent.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Sent</title>
</head>
<body>
    <h1>メッセージを送信しました</h1>

    <a href="{{ route('messages.index') }}">Indexに戻る</a>
    <a href="{{ url()->previous() }}">Back</a>
</body>
</html>
