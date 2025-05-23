<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Job;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the test user --- throw error if not found
        $testUser = User::where('email', 'test@test.com')->firstOrFail();

        // Get all job IDs
        $jobIds = Job::pluck('id')->toArray();

        // Randomly select job IDs to bookmark
        $randomJobIds = array_rand($jobIds, 3); // Change 3 to however many you want to bookmark

        // Attach the selected jobs as bookmarks for the test user
        foreach ($randomJobIds as $jobId) {
            // ** BOOKMARKED JOBS AS WE HAVE A RELATIONSHIP IN User.php **
            $testUser->bookmarkedJobs()->attach($jobIds[$jobId]);
        }
    }
}
