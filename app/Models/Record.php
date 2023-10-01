<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable = [
        'line_user_id', // LINEユーザーIDを指定
        'record_date', // レコードの日付を指定
        'time_of_day', // 1日の中での時間帯（例：朝、昼、晩）を指定
        'content', // コンテンツを指定
        'protein', // タンパク質を指定
        'lipid', // 脂質を指定
        'vitamin', // ビタミンを指定
        'carbohydrate', // 炭水化物を指定
        'mineral', // ミネラルを指定
        ];
}