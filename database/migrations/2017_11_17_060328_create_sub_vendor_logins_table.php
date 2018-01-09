<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubVendorLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_sub_vendor_logins', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->integer('sub_vendor_id')->unsigned();
            $table->integer('vendor_id')->unsigned(); //main vendor id



            $table->integer('sub_vendor_address_id');
            $table->integer('sub_vendor_venue_id')->unsigned();
            $table->integer('sub_vendor_court_id');
            $table->integer('sub_vendor_stall_id');
            $table->integer('is_ven_or_sub');  // is vendor or sub vendor 
            

            $table->foreign('sub_vendor_id')->references('id')->on('pg_vendor');

            $table->foreign('vendor_id')->references('id')->on('pg_vendor');


            $table->foreign('sub_vendor_address_id')->references('id')->on('pg_address');
            $table->foreign('sub_vendor_venue_id')->references('id')->on('pg_venue');
            $table->foreign('sub_vendor_court_id')->references('id')->on('pg_court');
            $table->foreign('sub_vendor_stall_id')->references('id')->on('pg_stall');


         

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_vendor_logins');
    }
}
