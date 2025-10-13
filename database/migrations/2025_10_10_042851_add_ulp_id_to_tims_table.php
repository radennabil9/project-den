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
    Schema::table('tims', function (Blueprint $table) {
        $table->unsignedBigInteger('ulp_id')->after('id')->nullable();

        $table->foreign('ulp_id')->references('id')->on('user_u_l_p_s')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('tims', function (Blueprint $table) {
        $table->dropForeign(['ulp_id']);
        $table->dropColumn('ulp_id');
    });
}

};
