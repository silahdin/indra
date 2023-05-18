<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestUserOngoings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user_ongoings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_user_ongoings_user_id_foreign');
            $table->unsignedInteger('module_career_id')->index('test_user_ongoings_module_career_id_foreign');
            $table->datetime('target')->nullable();
            $table->integer('status')->nullable(); // 0 = Initiate, 1 = Proceed, 2 = Finished
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_user_ongoings', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('module_career_id')->references('id')->on('test_career_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_user_ongoings', function (Blueprint $table) {
            $table->dropForeign('test_user_ongoings_user_id_foreign');
            $table->dropForeign('test_user_ongoings_module_career_id_foreign');
        });

        Schema::dropIfExists('test_user_ongoings');
    }
}
