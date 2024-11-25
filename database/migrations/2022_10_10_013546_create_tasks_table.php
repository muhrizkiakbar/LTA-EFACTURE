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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->date('delivery_date');
            $table->date('posting_date');
            $table->string('bp_code');
            $table->string('bp_name');
            $table->string('doc_num');
            $table->string('bp_ref_no');
            $table->string('original_amount');
            $table->integer('balance_due');
            $table->integer('user_id');
            $table->integer('assigned');
            $table->enum('status', ['open', 'finish'])->default('open');
            $table->softDeletes();
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
        Schema::dropIfExists('tasks');
    }
};
