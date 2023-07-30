<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("content");
            $table->unsignedBigInteger("categorie_id");
            $table->integer("hit")->default(0);
            $table->string("image");
            $table->string("slug");
            $table->integer("status")->default(0);
            $table->timestamps();

            $table->foreign("categorie_id")->references("id")->on("categories")->onDelete("cascade");
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
