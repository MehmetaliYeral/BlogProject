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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->boolean("status")->default(0); //aktiflik durumu.
            $table->boolean("feature_status")->default(0); //hangi kategoriler öne çıkarılsın.
            $table->string("description")->nullable();
            $table->unsignedBigInteger("parent_id")->nullable();
            $table->integer("order")->default(0); //sıralama için.
            $table->string("seo_keywords")->nullable(); //arama motorlarında arama yapacakken kullanacakları keyword.
            $table->string("seo_description")->nullable(); // bir web sayfasının html kodunda bulunan meta etiketi.
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            $table->foreign("parent_id")->references("id")->on("categories");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
