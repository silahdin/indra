<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupForeignNewCmsCareerFaq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('new_cms_career_faq', function (Blueprint $table) {
            $table->unsignedInteger('group_id')->index('new_cms_career_faq_group_id_foreign')->after('id');
        });

        Schema::table('new_cms_career_faq', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('new_cms_career_faq_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('new_cms_career_faq', function (Blueprint $table) {
            $table->dropForeign('new_cms_career_faq_group_id_foreign');
        });

        Schema::table('new_cms_career_faq', function (Blueprint $table) {
            $table->dropColumn(['group_id']);
        });
    }
}
