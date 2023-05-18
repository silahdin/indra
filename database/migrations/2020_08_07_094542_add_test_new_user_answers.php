<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestNewUserAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_new_user_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_new_user_answers_user_id_foreign');
            $table->string('code')->nullable();
            $table->text('answer')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_new_user_answers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_new_user_answers', function (Blueprint $table) {
            $table->dropForeign('test_new_user_answers_user_id_foreign');
        });

        Schema::dropIfExists('test_new_user_answers');
    }
}
