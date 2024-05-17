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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string("title"); //makalenin başlığı. 
            $table->string("slug");
            $table->text("body");
            $table->string("image")->nullable();
            $table->string("tags")->nullable();
            $table->boolean("status")->default(0);
            $table->integer("view_count")->default(0); //izlenme sayısı. 
            $table->integer("like_count")->default(0); //beğenme sayısı. 
            $table->integer("read_time")->default(0); //okuma sayısı. 
            $table->dateTime("publish_date")->nullable();//yayınlanma tarihi. 
            $table->string("seo_keywords")->nullable();
            $table->string("seo_description")->nullable();
            $table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("category_id");

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("category_id")->references("id")->on("categories");

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
