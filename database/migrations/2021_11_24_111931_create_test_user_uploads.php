<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestUserUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_user_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->index('test_user_uploads_user_id_foreign');
            $table->unsignedInteger('career_id')->index('test_new_user_answer_career_id')->nullable();
            $table->string('code')->nullable();
            $table->string('token')->nullable();
            $table->text('filename')->nullable();
            $table->text('filepath')->nullable();
            $table->text('url')->nullable();
            $table->timestamps();
        });

        Schema::table('test_user_uploads', function (Blueprint $table) {
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
        Schema::table('test_user_uploads', function (Blueprint $table) {
            $table->dropForeign('test_user_uploads_user_id_foreign');
        });

        Schema::dropIfExists('test_user_uploads');
    }
}
