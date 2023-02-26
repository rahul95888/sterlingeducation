<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyCommoditiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('commodities', 'from_price')) {
            Schema::table('commodities', function (Blueprint $table) {
                $table->dropColumn('from_price');
            });
        }
        if (Schema::hasColumn('commodities', 'to_price')) {
            Schema::table('commodities', function (Blueprint $table) {
                $table->dropColumn('to_price');
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
