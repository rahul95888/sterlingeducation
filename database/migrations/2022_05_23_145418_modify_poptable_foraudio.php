<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPoptableForaudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('pops', 'audio')) {
            Schema::table('pops', function (Blueprint $table) {
                $table->string('audio')->nullable()->after('image');
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
        Schema::table('pops', function (Blueprint $table) {
            //
        });
    }
}
