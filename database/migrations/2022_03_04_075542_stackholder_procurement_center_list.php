<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StackholderProcurementCenterList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stackholder_procurement_center_list', function (Blueprint $table) {
            $table->id();
            $table->string('stackholder_uid');
            $table->enum('stackholder_type', ['farmer', 'fpo', 'processor', 'trader']);
            $table->text('warehouse_address');
            $table->decimal('warehouse_capacity', 10, 3);
            $table->string('capacity_unit');
            $table->string('warehouse_type')->nullable();
            $table->string('state_uid');
            $table->string('district_uid');
            $table->string('sub_district_uid');
            $table->string('village_uid');

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
        Schema::dropIfExists('stackholder_procurement_center_list');
    }
}
