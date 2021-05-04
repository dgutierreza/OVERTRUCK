<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->date('date_btd')->nullable();
            $table->char('sex',1)->nullable();
            $table->char('est_civ',1)->nullable();
            $table->string('adress_dni',400)->nullable();
            $table->string('adress_home',400)->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('email_personal')->unique()->nullable();
            $table->string('celphone_pri')->nullable();
            $table->string('celphone_sec')->nullable();
            $table->string('celphone_job')->nullable();
            $table->integer('num_childs')->default(0);
            $table->char('account_sueldo',15)->nullable();
            $table->char('account_cts',15)->nullable();
            $table->date('date_entry')->nullable();
            $table->date('date_vig_dni')->nullable();
            $table->date('date_vig_contrato')->nullable();
            $table->date('date_vig_license')->nullable();
            $table->date('date_vig_license_esp')->nullable();
            $table->date('date_vig_sucamec')->nullable();
            $table->date('date_vig_matpel')->nullable();
            $table->string('path')->nullable();
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
        Schema::dropIfExists('users_detail');
    }
}
