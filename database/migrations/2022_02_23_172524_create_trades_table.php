<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trades', function (Blueprint $table) {
            $table->id();
            $table->string('trade_uid');
            $table->string('unique_user_id');
            $table->string('commodity_uid');
            $table->string('variety_uid');
            $table->text('description')->nullable();
            $table->double('quantity', 8, 2)->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
            $table->text('address')->nullable();
            $table->string('taluka')->nullable();
            $table->string('state_uid')->nullable();
            $table->string('city_uid')->nullable();
            $table->string('pincode_uid')->nullable();
            $table->string('country_uid')->nullable();
            $table->string('file')->nullable();

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
        Schema::dropIfExists('trades');
    }
}
