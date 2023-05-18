<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestUserCareers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user_careers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_user_careers_user_id_foreign');
            $table->integer('career_id')->index('test_user_careers_career_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_user_careers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('career_id')->references('id')->on('cms_career');
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
            $table->dropForeign('test_user_careers_user_id_foreign');
            $table->dropForeign('test_user_careers_career_id_foreign');
        });

        Schema::dropIfExists('test_user_careers');
    }
}
