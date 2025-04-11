<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_user_bookmarks', function (Blueprint $table) {
            $table->id();
            //  constraint --> Only allow values in this column that already exist in the referenced column of the referenced table.
            //  constraint only use on keys foreighn / ids
            // laravel uses the plural as the table name
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained('job_listings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drops the entire table 
        Schema::dropIfExists('job_user_bookmarks');
    }
};
