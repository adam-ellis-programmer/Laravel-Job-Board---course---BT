<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // clear the table
        DB::table('job_listings')->truncate();
        Schema::table('job_listings', function (Blueprint $table)
         {
            // large range integer - and where placed -- creates the field
            $table->unsignedBigInteger('user_id')->after('id');

            $table->integer('salary');
            $table->string('tags')->nullable(); // not required
            $table->enum('job_type', ['Full-Time', 'Part-Time', 'Contract', 'Temporary', 'Internship', 'Volunteer', 'On-Call'])->default('Full-Time');
            $table->boolean('remote')->default(false);
            $table->text('requirements')->nullable();
            $table->text('benefits')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zipcode')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_website')->nullable();
 
            // Adding a foreign key constraint --- references the table
            // added to job listings table
            // cascade when the parent is deleted, automatically delete all child records
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {
            $table->dropColumn(['salary', 'tags', 'job_type', 'remote', 'requirements', 'benefits', 'address', 'city', 'state', 'zipcode', 'contact_email', 'contact_phone', 'company_name', 'company_description', 'company_logo', 'company_website']);
            
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
