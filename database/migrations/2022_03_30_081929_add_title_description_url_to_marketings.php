<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleDescriptionUrlToMarketings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('marketings', 'banner_title')) {
            Schema::table('marketings', function (Blueprint $table) {
                $table->string('banner_title')->after('marketing_uid');
            });
        }
        if (!Schema::hasColumn('marketings', 'banner_description')) {
            Schema::table('marketings', function (Blueprint $table) {
                $table->string('banner_description')->after('banner_title');
            });
        }
        if (!Schema::hasColumn('marketings', 'banner_url')) {
            Schema::table('marketings', function (Blueprint $table) {
                $table->string('banner_url')->nullable()->after('banner_description');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
