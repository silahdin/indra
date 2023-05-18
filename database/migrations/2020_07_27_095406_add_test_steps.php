<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTestSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('module_id')->index('test_steps_module_id_foreign');
            $table->string('name')->nullable();
            $table->integer('order')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('test_steps', function (Blueprint $table) {
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
        Schema::table('test_steps', function (Blueprint $table) {
            $table->dropForeign('test_steps_module_id_foreign');
        });

        Schema::dropIfExists('test_steps');
    }
}
