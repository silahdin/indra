<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestGroupAnswerColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_group_answer_columns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_answer_row_id')->index('test_group_answer_columns_group_answer_row_id_foreign');
            $table->string('code')->nullable();
            $table->string('group_code')->nullable();
            $table->text('text')->nullable();
            $table->string('right_answer')->nullable();
            $table->integer('score')->nullable();
            $table->integer('disabled')->nullable(); // 1 = Yes, 0 = No
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_group_answer_columns', function (Blueprint $table) {
            $table->foreign('group_answer_row_id')->references('id')->on('test_group_answer_rows');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_group_answer_columns', function (Blueprint $table) {
            $table->dropForeign('test_group_answer_columns_group_answer_row_id_foreign');
        });

        Schema::dropIfExists('test_group_answer_columns');
    }
}
