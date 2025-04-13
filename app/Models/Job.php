<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job_listings';

    // mass asignment - prevents users modifying collumns
    protected $fillable = [
        'title',
        'description',
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirements',
        'benefits',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_email',
        'contact_phone',
        'company_name',
        'company_description',
        'company_logo',
        'company_website',
        'user_id',
    ];
    // relation to User
    //  we can then call user->jobListing
    // job belongs to the user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    // now we can use $job->bookMarkedByUsers and retrieve the users that bookmarked that job
    // bookmarks can be bookmarked by multiple users 
    // every time a user bookmarks a card
    // that data goes in the job_users_bookmarks table
    // we retrieve all the ids of the bookmarks belonging to that user 
    // $job->bookMarkedByUsers
    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks')->withTimestamps();
    }


    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }
}
 


// *** for tinker ***
// $job::create([
//     'title' => 'Job four',
//     'description' => 'This is an description for job four',
// ]);

// $job = App\Models\Job::class
// $job::find(1)->update(['title' => 'Updated Job One'])
//  $job::find(2)->delete()