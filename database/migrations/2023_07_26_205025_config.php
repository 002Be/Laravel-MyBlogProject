<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string("title")->default("Blog");;
            $table->string("logo")->nullable();
            $table->string("favicon")->nullable();
            $table->integer("active")->default(1);
            $table->string("linkedin")->nullable();
            $table->string("github")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
