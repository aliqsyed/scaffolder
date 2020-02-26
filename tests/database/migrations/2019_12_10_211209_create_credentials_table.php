<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testcredentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('credential_type');
            $table->text('disapproval_reason')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->dateTime('some_date');
            $table->unsignedBigInteger('testuser_id');
            $table->foreign('testuser_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('credentials');
    }
}
