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
            $table->unsignedBigInteger("categorie_id"); //? unsigned : minimum 0 değerini alsın
            $table->integer("hit")->default(0);
            $table->string("image");
            $table->string("slug");
            $table->integer("status")->default(0);
            $table->timestamps();

            $table->foreign("categorie_id")->references("id")->on("categories")->onDelete("cascade");
            //? Bağlanacak sütün -> Referans alınacak sütun -> Tablo -> Eğer categori tablosundaki bir kategori silinirse ona bağlı olan satırları bu tablodan siler
            //? Bu sayede Categories tablosundaki id sütunuyla, Articles tablosundaki categorie_id sütunuyla ilişki kurmuş oluyor
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
