<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'aadhar_upload_date')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('aadhar_upload_date')->nullable()->after('aadhar_document');
            });
        }
        if (!Schema::hasColumn('users', 'gst_upload_date')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('gst_upload_date')->nullable()->after('gst_document');
            });
        }
        if (!Schema::hasColumn('users', 'bank_upload_date')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('bank_upload_date')->nullable()->after('bank_document');
            });
        }
        if (!Schema::hasColumn('users', 'address_upload_date')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('address_upload_date')->nullable()->after('address_document');
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
