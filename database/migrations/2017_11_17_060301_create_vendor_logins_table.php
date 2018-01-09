<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \App\models;

class CreateVendorLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_vendor_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');


            $table->integer('vendor_id')->unsigned();
  
            $table->integer('vendor_address_id');
            $table->integer('vendor_venue_id')->unsigned();
            $table->integer('vendor_court_id');
            $table->integer('vendor_stall_id');

            
            $table->foreign('vendor_id')->references('id')->on('pg_vendor');

            $table->foreign('vendor_address_id')->references('id')->on('pg_address');
            $table->foreign('vendor_venue_id')->references('id')->on('pg_venue');
            $table->foreign('vendor_court_id')->references('id')->on('pg_court');
            $table->foreign('vendor_stall_id')->references('id')->on('pg_stall');


         

            $table->integer('is_ven_or_sub');  // is vendor or sub vendor 

            $table->rememberToken();

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
        Schema::dropIfExists('vendor_logins');
    }
}
