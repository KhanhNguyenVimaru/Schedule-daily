<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_writtings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text("before_sleep");
            $table->text("after_wakeup");
            $table->text("lession");

            $table->unsignedBigInteger("status_id")->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_writtings');
    }
};
