<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserTableProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'ho_location')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('ho_location')->nullable()->after('user_type');
            });
        }
        if (!Schema::hasColumn('users', 'job_works')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('job_works')->nullable()->after('user_type');
            });
        }
        if (!Schema::hasColumn('users', 'mandi_registration_details')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('mandi_registration_details')->nullable()->after('user_type');
            });
        }
        if (!Schema::hasColumn('users', 'branch_locations')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('branch_locations')->nullable()->after('user_type');
            });
        }
        if (!Schema::hasColumn('users', 'process_method_uid')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('process_method_uid')->nullable()->after('user_type');
            });
        }
        
        if (!Schema::hasColumn('users', 'process_capability_uid')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('process_capability_uid')->nullable()->after('user_type');
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
