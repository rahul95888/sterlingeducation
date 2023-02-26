<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyVaritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('varieties', 'from_price')) {
            Schema::table('varieties', function (Blueprint $table) {
                $table->decimal('from_price', 10, 2)->default(0)->after('commodity_uid');
            });
        }
        if (!Schema::hasColumn('varieties', 'to_price')) {
            Schema::table('varieties', function (Blueprint $table) {
                $table->decimal('to_price', 10, 2)->default(0)->after('from_price');
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
