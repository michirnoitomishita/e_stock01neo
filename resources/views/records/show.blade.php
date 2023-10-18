<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Record Details</title>
</head>
<body>
    <h1>Record Details</h1>
    <p><strong>ID:</strong> {{ $record->id }}</p>
    <p><strong>Line User ID:</strong> {{ $record->line_user_id }}</p>
    <p><strong>Record Date:</strong> {{ $record->record_date }}</p>
    <p><strong>Time of Day:</strong> {{ $record->time_of_day }}</p>
    <p><strong>Content:</strong> {{ $record->content }}</p>
    <p><strong>Protein:</strong> {{ $record->protein }} g</p> <!-- gを追加 -->
    <p><strong>Lipid:</strong> {{ $record->lipid }} g</p> <!-- gを追加 -->
    <p><strong>Vitamin:</strong> {{ $record->vitamin }} g </p> <!-- 必要な単位を追加 -->
    <p><strong>Carbohydrate:</strong> {{ $record->carbohydrate }} g</p> <!-- gを追加 -->
    <p><strong>Mineral:</strong> {{ $record->mineral }} g </p> <!-- 必要な単位を追加 -->
    <p><strong>Created At:</strong> {{ $record->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $record->updated_at }}</p>

<form action="{{ route('message.create', ['id' => $record->id]) }}" method="POST">
    @csrf
    <button type="submit">Create and Send Message</button>
</form>


<a href="{{ url()->previous() }}">Back</a>
</body>
</html>
