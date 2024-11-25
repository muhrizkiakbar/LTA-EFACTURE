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
        Schema::create('cras', function (Blueprint $table) {
            $table->id();
            $table->string('bp_code');
            $table->string('bp_name');
            $table->enum('type', ['CN', 'IN']);
            $table->string('doc_num');
            $table->date('doc_date')->nullable();
            $table->date('post_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('bp_ref_no');
            $table->integer('original_amount');
            $table->integer('balance_due');
            $table->enum('pt', ['LTA', 'TAA']);
            $table->string('branch');
            $table->date('delivery_date')->nullable();
            $table->string('pic_admin')->nullable();
            $table->string('note')->nullable();
            $table->string('remark')->nullable();
            $table->enum('status', ['open', 'progress', 'done', 'close'])->default('close');
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
        Schema::dropIfExists('cras');
    }
};
