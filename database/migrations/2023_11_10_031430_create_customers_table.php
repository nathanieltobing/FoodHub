<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone')->nullable();
            $table->date('dob')->nullable();
            $table->string('image')->nullable();
            $table->json('customer_membership');
            $table->rememberToken()->NULL;
            $table->enum('role', ['CUSTOMER' , 'VENDOR' , 'ADMIN']);
            $table->enum('status', ['ACTIVE' , 'SUSPENDED']);
            $table->foreignId('status_updated_by');
            $table->foreign('status_updated_by')->references('id')->on('admins')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
