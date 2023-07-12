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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->string('title');
            $table->text('description');
            $table->bigInteger('posted_by')->unsigned();
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->on('categories')->references('id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('posted_by')->on('users')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
