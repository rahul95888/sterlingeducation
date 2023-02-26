<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserProcurements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('user_procurements', 'warehouse_address')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->text('warehouse_address')->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'warehouse_capacity')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->decimal('warehouse_capacity', 10, 2)->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'warehouse_type_uid')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->string('warehouse_type_uid')->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'state_uid')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->string('state_uid')->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'district_uid')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->string('district_uid')->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'sub_district_uid')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->string('sub_district_uid')->nullable()->change();
            });
        }
        if (Schema::hasColumn('user_procurements', 'village_uid')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->string('village_uid')->nullable()->change();
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
        //
    }
}
