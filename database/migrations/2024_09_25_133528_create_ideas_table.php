<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * varchar 240 char
     * likes int
     * comments int
     * shares int
     */
    public function up(): void
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();  // Auto-incrementing primary key
            $table->timestamps();  // Created_at and updated_at timestamps
           
            $table->string('content', 240);  // varchar(240) for content
            $table->integer('likes')->default(0);  // Integer for likes, default 0
            $table->integer('comments')->default(0);  // Integer for comments, default 0
            $table->integer('shares')->default(0);  // Integer for shares, default 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');  // Drop the table if it exists
    }
};
