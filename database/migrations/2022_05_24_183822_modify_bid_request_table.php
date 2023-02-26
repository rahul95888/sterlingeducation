<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBidRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('bids', 'status_by')) {
            Schema::table('bids', function (Blueprint $table) {
                $table->string('status_by')->nullable()->after('status');
            });
        }
        if (!Schema::hasColumn('bids', 'status_date')) {
            Schema::table('bids', function (Blueprint $table) {
                $table->timestamp('status_date')->nullable()->after('status_by');
            });
        }
        if (!Schema::hasColumn('bids', 'comment')) {
            Schema::table('bids', function (Blueprint $table) {
                $table->text('comment')->nullable()->after('status_date');
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
        Schema::table('bids', function (Blueprint $table) {
            //
        });
    }
}
