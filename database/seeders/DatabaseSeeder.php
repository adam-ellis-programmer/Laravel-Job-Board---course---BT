<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Truncate tables == CLEAR ALL DATA before we seed
        DB::table('job_listings')->truncate();
        DB::table('users')->truncate();

        //  What $this->call() does is run another seeder class from within the current seeder. 
        // Selectively run certain seeders when needed
        $this->call(TestUserSeeder::class); // Add this line
        $this->call(RandomUserSeeder::class);
        $this->call(JobSeeder::class);
    }
}
