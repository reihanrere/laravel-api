<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     * https://dev.to/livingstone94/e-learning-database-design-54hc
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('answer_1',100);
            $table->string('answer_2',100);
            $table->string('answer_3',100);
            $table->string('answer_4',100);
            $table->string('answer_5',100);
            $table->string('correct_answer',100);
            $table->foreignId('lesson_id')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
