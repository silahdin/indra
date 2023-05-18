<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestCareerModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_career_modules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('career_id')->index('test_career_modules_career_id_foreign');
            $table->unsignedInteger('module_id')->index('test_career_modules_module_id_foreign');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_career_modules', function (Blueprint $table) {
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
        Schema::table('test_career_modules', function (Blueprint $table) {
            $table->dropForeign('test_career_modules_career_id_foreign');
            $table->dropForeign('test_career_modules_module_id_foreign');
        });

        Schema::dropIfExists('test_career_modules');
    }
}
