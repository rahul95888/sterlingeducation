<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_factors', function (Blueprint $table) {
            $table->id();
            $table->string('farm_factor_uid');
            $table->string('farm_factor_name');

            $table->string('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->string('modifed_by')->nullable();
            $table->string('modifed_ip')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unique(['farm_factor_name', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farm_factors');
    }
}
