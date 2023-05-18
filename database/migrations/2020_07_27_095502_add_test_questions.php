<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('step_id')->index('test_questions_step_id_foreign');
            $table->string('type'); // Question, Title, Storyline, Image
            $table->string('code')->nullable();
            
            $table->integer('required')->nullable(); // 1 = Yes, 2 = No
            $table->integer('order')->default(1);
            $table->integer('column')->default(1);
            $table->integer('alignment')->default(1); // 1 = Horizontal, 2 = Vertical

            $table->text('line_text')->nullable();
            $table->text('image_url')->nullable();
            $table->integer('image_height')->nullable();

            $table->string('answer_type')->nullable(); // Plain, Choices, Group

            $table->text('text')->nullable();
            $table->string('plain_type')->nullable(); // Text, TextArea, Option
            $table->string('question_option')->nullable();

            $table->integer('answer_alignment')->nullable(); // 1 = Horizontal, 2 = Vertical
            $table->integer('answer_max_column')->nullable();
            $table->integer('use_explanation')->nullable(); // 1 = Yes, 0 = No

            $table->string('right_answer')->nullable(); // For Choices, Number or Text input
            $table->integer('score')->nullable();

            $table->integer('group_answer_type')->nullable(); // 1 = Text, 2 = Radio
            $table->integer('transpose_group')->nullable(); // 1 = Yes, 0 = No
            $table->integer('only_one_choice')->nullable(); // 1 = Yes, 0 = No
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_questions', function (Blueprint $table) {
            $table->foreign('step_id')->references('id')->on('test_steps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_questions', function (Blueprint $table) {
            $table->dropForeign('test_questions_step_id_foreign');
        });

        Schema::dropIfExists('test_questions');
    }
}
