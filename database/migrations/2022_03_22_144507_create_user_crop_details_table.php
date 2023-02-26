<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCropDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_crop_details', function (Blueprint $table) {
            $table->id();
            $table->string('unique_user_id')->comment('Associated user unique user id');
            $table->string('user_crop_detail_uid');
            $table->string('commodity_uid')->nullable();
            $table->string('variety_uid')->nullable();
            $table->decimal('acreage', 10, 2)->nullable();
            $table->tinyInteger('primary_processing_method')->default(0);
            $table->timestamp('sowling_date')->nullable();
            $table->string('farm_location')->nullable();

            //trader
            $table->enum('form_factor', ['raw', 'dried', 'powder', 'flakes'])->nullable();
            $table->string('tonnage_daily')->nullable();
            $table->string('tonnage_monthly')->nullable();
            $table->string('tonnage_yearly')->nullable();
            $table->string('state_uid')->nullable();
            $table->string('district_uid')->nullable();
            $table->string('sub_district_uid')->nullable();
            $table->string('village_uid')->nullable();
            $table->string('ho_location')->nullable();
            $table->text('branch_locations')->nullable()->comment('Serialize array of district_uid -> district multi select');
            $table->text('process_method_uid')->nullable()->comment('Serialize array of process_method_uid -> process method multi select');
            $table->string('mandi_registration_details')->nullable();

            //processor
            $table->text('process_capability_uid')->nullable()->comment('Serialize array of process_capability_uid -> process capability multi select');
            $table->string('daily_plant_capabality')->nullable();
            $table->string('weekly_plant_capabality')->nullable();
            $table->string('monthly_plant_capabality')->nullable();
            $table->integer('number_of_farmers_connected')->nullable();
            $table->string('job_works')->nullable();

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
        Schema::dropIfExists('user_crop_details');
    }
}
