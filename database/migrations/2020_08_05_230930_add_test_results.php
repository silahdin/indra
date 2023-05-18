<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestResults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_results_user_id_foreign');
            $table->integer('career_id')->index('test_results_career_id_foreign');
            $table->unsignedInteger('module_id')->index('test_results_module_id_foreign');
            $table->integer('score_automated')->nullable();
            $table->integer('score_marking')->nullable();
            $table->integer('status')->nullable(); // 0 = Not Completed, 1 = Completed
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_results', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('career_id')->references('id')->on('cms_career');
            $table->foreign('module_id')->references('id')->on('test_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('test_results', function (Blueprint $table) {
            $table->dropForeign('test_results_user_id_foreign');
            $table->dropForeign('test_results_career_id_foreign');
            $table->dropForeign('test_results_module_id_foreign');
        });

        Schema::dropIfExists('test_results');
    }
}
