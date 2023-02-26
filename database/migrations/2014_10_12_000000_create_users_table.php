<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_user_id')->nullable();
            $table->string('mobile_number');
            $table->string('otp')->nullable();
            $table->timestamp('otp_verified_at')->nullable();
            $table->timestamp('registered_at')->nullable();
            $table->string('registered_from')->nullable();
            $table->rememberToken();

            //farmer
            $table->string('name')->nullable();
            $table->timestamp('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('education_uid')->nullable();

            //fpo
            $table->string('company_name')->nullable();
            $table->string('contact_person')->nullable();
            $table->integer('number_of_farmers_connected')->nullable();

            //common info
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('country_uid')->nullable();
            $table->string('state_uid')->nullable();
            $table->string('district_uid')->nullable();
            $table->string('sub_district_uid')->nullable();
            $table->string('village_uid')->nullable();
            $table->string('pincode_uid')->nullable();

            //plan for documnets
            $table->string('aadhar_number')->nullable();
            $table->string('aadhar_document')->nullable();

            $table->string('gst_number')->nullable();
            $table->string('gst_document')->nullable();

            $table->string('account_number')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('bank_document')->nullable();

            $table->string('address_document_type')->nullable();
            $table->string('address_document_id_number')->nullable();
            $table->string('address_document')->nullable();

            $table->enum('kyc_status', ['pending', 'accepted', 'rejected'])->nullable();
            $table->enum('user_type', ['farmer', 'fpo', 'trader', 'processor'])->nullable();

            $table->string('created_by')->nullable();
            $table->string('created_ip')->nullable();
            $table->string('modifed_by')->nullable();
            $table->string('modifed_ip')->nullable();
            $table->string('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unique(['mobile_number', 'deleted_at']);
            $table->unique(['email', 'deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
