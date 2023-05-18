<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewCmsCareerImplementation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_career', function (Blueprint $table) {
            $table->string('position', 100)->nullable()->after('position_ch');
            $table->string('jobdesk_in', 500)->nullable()->after('jobdesk_ch');
            $table->string('requirement_in', 2000)->nullable()->after('requirement_en');
            $table->string('location', 100)->nullable()->after('location_ch');
            $table->mediumText('detRole_in')->nullable()->after('detRole_en');
            $table->mediumText('detRespon_in')->nullable()->after('detRespon_en');
            $table->mediumText('detSkill_in')->nullable()->after('detSkill_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_career', function (Blueprint $table) {
            $table->dropColumn(['position', 'jobdesk_in', 'requirement_in', 'location', 'detRole_in', 'detRespon_in', 'detSkill_in']);
        });
    }
}
