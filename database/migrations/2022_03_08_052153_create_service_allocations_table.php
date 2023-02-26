<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceAllocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_allocations', function (Blueprint $table) {
            $table->id();
            $table->string('service_allocation_uid');
            $table->string('service_uid');
            $table->string('state_uid')->nullable();
            $table->string('district_uid')->nullable();
            $table->string('sub_district_uid')->nullable();
            $table->string('village_uid')->nullable();

            $table->string('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->string('modifed_by')->nullable();
            $table->string('modifed_ip')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_allocations');
    }
}
