<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeoCmsSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_setting', function (Blueprint $table) {
            $table->string('meta_keyword_id')->nullable()->after('charimanmsg_ch');
            $table->string('meta_keyword_en')->nullable()->after('charimanmsg_ch');
            $table->string('meta_description_id')->nullable()->after('charimanmsg_ch');
            $table->string('meta_description_en')->nullable()->after('charimanmsg_ch');
            $table->string('meta_title_id')->nullable()->after('charimanmsg_ch');
            $table->string('meta_title_en')->nullable()->after('charimanmsg_ch');
            $table->string('site_name_id')->nullable()->after('charimanmsg_ch');
            $table->string('site_name_en')->nullable()->after('charimanmsg_ch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_setting', function (Blueprint $table) {
            $table->dropColumn(['meta_keyword_id', 'meta_keyword_en', 'meta_description_id', 'meta_description_en', 'meta_title_id', 'meta_title_en', 'site_name_id', 'site_name_en']);
        });
    }
}
