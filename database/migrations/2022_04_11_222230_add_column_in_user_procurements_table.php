<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUserProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('user_procurements', 'user_type')) {
            Schema::table('user_procurements', function (Blueprint $table) {
                $table->enum('user_type', ['farmer', 'fpo', 'trader', 'processor'])->nullable()->after('unique_user_id');
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
