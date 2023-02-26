<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_prices', function (Blueprint $table) {
            $table->id();
            $table->string('market_price_uid');
            $table->string('state');
            $table->string('district');
            $table->string('market');
            $table->string('commodity');
            $table->string('variety');
            $table->string('arrival_date');
            $table->string('current_min_price');
            $table->string('current_max_price');
            $table->string('current_modal_price');
            $table->string('previous_min_price');
            $table->string('previous_max_price');
            $table->string('previous_modal_price');
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
        Schema::dropIfExists('market_prices');
    }
}
