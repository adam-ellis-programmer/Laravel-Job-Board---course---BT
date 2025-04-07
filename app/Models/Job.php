<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // use HasFactory;
    protected $table = 'job_listings';
    // mass asignment - prevents users modifying collumns
    protected $fillable = ['title', 'description'];

}
 


// *** for tinker ***
// $job::create([
//     'title' => 'Job four',
//     'description' => 'This is an description for job four',
// ]);

// $job = App\Models\Job::class
// $job::find(1)->update(['title' => 'Updated Job One'])
//  $job::find(2)->delete()