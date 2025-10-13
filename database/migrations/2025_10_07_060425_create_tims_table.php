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
        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('nama_regu');
            $table->string('anggota'); 
            $table->unsignedBigInteger('user_ulp_id'); 
            $table->timestamps();

            $table->foreign('user_ulp_id')->references('id')->on('user_u_l_p_s')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tims');
    }
};
