<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCareerIdToNewAnswer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('test_new_user_answers', function (Blueprint $table) {
            $table->unsignedInteger('career_id')->index('test_new_user_answer_career_id')->after('user_id')->nullable();
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
            $table->dropColumn('career_id');
        });
    }
}
