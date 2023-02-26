<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserCropDetailsCityUid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('user_crop_details', 'city_uid')) {
            Schema::table('user_crop_details', function (Blueprint $table) {
                $table->string('city_uid')->nullable()->after('state_uid');
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
        Schema::table('user_crop_details', function (Blueprint $table) {
            //
        });
    }
}
