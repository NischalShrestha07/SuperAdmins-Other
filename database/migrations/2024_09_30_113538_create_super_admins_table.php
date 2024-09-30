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
        Schema::create('super_admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('companyName');
            $table->string('email')->unique();
            $table->string('password');
            // $table->string('role_name')->unique();
            $table->unsignedBigInteger('role_id'); // Reference to the roles table
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); // Add foreign key constraint


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admins');
    }
};
