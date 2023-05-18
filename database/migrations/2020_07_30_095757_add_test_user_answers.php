<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestUserAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_user_answers_user_id_foreign');
            $table->unsignedInteger('question_id')->nullable()->index('test_user_answers_question_id_foreign');
            $table->unsignedInteger('group_answer_column_id')->nullable()->index('test_user_answers_group_answer_column_id_foreign');
            $table->unsignedInteger('multiple_input_id')->nullable()->index('test_user_answers_multiple_input_id_foreign');
            $table->text('answer')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_user_answers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('question_id')->references('id')->on('test_questions');
            $table->foreign('group_answer_column_id')->references('id')->on('test_group_answer_columns');
            $table->foreign('multiple_input_id')->references('id')->on('test_multiple_inputs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_user_answers', function (Blueprint $table) {
            $table->dropForeign('test_user_answers_user_id_foreign');
            $table->dropForeign('test_user_answers_question_id_foreign');
            $table->dropForeign('test_user_answers_group_answer_column_id_foreign');
            $table->dropForeign('test_user_answers_multiple_input_id_foreign');
        });

        Schema::dropIfExists('test_user_answers');
    }
}
