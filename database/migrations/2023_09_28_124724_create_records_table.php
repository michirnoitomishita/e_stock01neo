<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('line_user_id'); // LINEユーザーIDを追加
            $table->date('record_date'); // 日付を追加
            $table->enum('time_of_day', ['morning', 'afternoon', 'evening']); // 朝昼晩を追加
            $table->text('content')->nullable(); // contentを追加、nullを許可
            $table->float('protein');
            $table->float('lipid');
            $table->float('vitamin');
            $table->float('carbohydrate');
            $table->float('mineral');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
