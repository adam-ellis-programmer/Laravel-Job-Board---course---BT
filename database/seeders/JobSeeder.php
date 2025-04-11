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

        // Get the ID of the user created by TestUserSeeder
        $testUserId = User::where('email', 'test@test.com')->value('id');

        // Get all other user IDs
        $userIds = User::where('email', '!=', 'test@test.com')->pluck('id')->toArray();

        // The & before $listing is important because it creates a reference to 
        // the original array element rather than a copy. This means any changes 
        // made to $listing inside the loop will directly modify the original 
        // $jobListings array. Without the &, changes would only affect a copy 
        // of each element, and the original array would remain unchanged.

        // foreach ($jobListings as $index => $listing) {
        // echo "Job at index {$index}: {$listing['title']}\n";
        // }

        // In this code, the & symbol before $listing creates a reference to the original array element rather than a copy.
        // When you set $listing['user_id'] = $userIds[array_rand($userIds)], you're actually changing the value in the original $jobListings array.
        // Without the & (reference operator), PHP would create a copy of each element, and any changes you make to that copy would not affect the original array.
        // Using the reference is more memory-efficient for large arrays because it doesn't create copies of each element.
        foreach ($jobListings as $index => &$listing) {
            if ($index < 3) {
                // Assign the first two job listings to the test user
                $listing['user_id'] = $testUserId;
            } else {
                // Assign the rest to random users
                // set the user_id field
                $listing['user_id'] = $userIds[array_rand($userIds)];
            }
            // Add timestamps
            $listing['created_at'] = now();
            $listing['updated_at'] = now();
        }

        // Insert job listings
        DB::table('job_listings')->insert($jobListings);
        echo 'Jobs Crated Successfully!';
    }
}
