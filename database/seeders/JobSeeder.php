<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
use App\Models\User;


class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Load job listings data
    $jobListings = include database_path('seeders/data/job_listings.php');

    // Get all user IDs
    $userIds = User::pluck('id')->toArray();

    // The & before $listing is important because it creates a reference to 
    // the original array element rather than a copy. This means any changes 
    // made to $listing inside the loop will directly modify the original 
    // $jobListings array. Without the &, changes would only affect a copy 
    // of each element, and the original array would remain unchanged.

    // foreach ($jobListings as $index => $listing) {
    // echo "Job at index {$index}: {$listing['title']}\n";
    // }

    foreach ($jobListings as &$listing) {
        // Assign a random user_id to each job listing
        $listing['user_id'] = $userIds[array_rand($userIds)];
         // Add timestamps
        $listing['created_at'] = now();
        $listing['updated_at'] = now();
    }

        // Insert job listings
        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs Crated Successfully!';
    }
}
