@extends('layouts.app')

@section('content')
<div>
    <h2>Record Detail</h2>
    <p>Line User ID: {{ $record->line_user_id }}</p>
    <p>Record Date: {{ $record->record_date }}</p>
    <p>Time of Day: {{ $record->time_of_day }}</p>
    <p>Content: {{ $record->content }}</p>
    <p>Protein: {{ $record->protein }}</p>
    <p>Lipid: {{ $record->lipid }}</p>
    <p>Vitamin: {{ $record->vitamin }}</p>
    <p>Carbohydrate: {{ $record->carbohydrate }}</p>
    <p>Mineral: {{ $record->mineral }}</p>
    <p>Created At: {{ $record->created_at }}</p>
    <p>Updated At: {{ $record->updated_at }}</p>
</div>
@endsection
