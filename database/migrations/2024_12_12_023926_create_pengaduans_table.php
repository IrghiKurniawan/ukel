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
        Schema::create('pengaduans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('description');
            $table->enum('type', ['KEJAHATAN', 'PEMBANGUNAN', 'SOSIAL']);
            $table->string('province');
            $table->string('regency');
            $table->string('subdistrict');
            $table->string('village');
            $table->json('voting')->default(json_encode([])); 
            $table->integer('viewers')->default(0);
            $table->string('image');
            $table->boolean('statement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduans');
    }
};
