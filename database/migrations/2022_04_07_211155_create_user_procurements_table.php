<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProcurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_procurements', function (Blueprint $table) {
            $table->id();
            $table->string('unique_user_id')->comment('Associated user unique user id');
            $table->string('user_procurement_uid');
            $table->text('warehouse_address');
            $table->decimal('warehouse_capacity', 10, 2);
            $table->string('warehouse_type_uid');
            $table->string('state_uid');
            $table->string('district_uid');
            $table->string('sub_district_uid');
            $table->string('village_uid');

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
        Schema::dropIfExists('user_procurements');
    }
}
