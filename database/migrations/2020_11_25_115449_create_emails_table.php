<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('email_list_id');
            $table->string('token', 100);
            $table->string('email');
            $table->string('user_name', 50)->nullable();
            $table->string('organisation', 255)->nullable();
            $table->string('source', 255)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('email_list_id')
                ->references('id')
                ->on('email_lists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
}
