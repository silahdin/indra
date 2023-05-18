<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestGroupAnswerRows extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_group_answer_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('question_id')->index('test_group_answer_rows_question_id_foreign');
            $table->string('code')->nullable();
            $table->string('group_code')->nullable();
            $table->text('text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_group_answer_rows', function (Blueprint $table) {
            $table->foreign('question_id')->references('id')->on('test_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_group_answer_rows', function (Blueprint $table) {
            $table->dropForeign('test_group_answer_rows_question_id_foreign');
        });

        Schema::dropIfExists('test_group_answer_rows');
    }
}
