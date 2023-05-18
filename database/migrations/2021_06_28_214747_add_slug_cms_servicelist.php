<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugCmsServicelist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_servicelist', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name_ch');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_servicelist', function (Blueprint $table) {
            $table->dropColumn(['slug']);
        });
    }
}
