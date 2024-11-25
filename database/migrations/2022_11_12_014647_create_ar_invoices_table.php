<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ar_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('DocNum')->unique();
            $table->string('CardCode');
            $table->string('CardName');
            $table->string('Street');
            $table->string('LicTradNum');
            $table->string('status');
            $table->integer('branch_id');
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
        Schema::dropIfExists('ar_invoices');
    }
};
