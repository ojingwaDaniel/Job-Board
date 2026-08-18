<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;
    protected $fillable = ['expected_salary','user_id'];
    public function user(){
        $this->belongsTo(User::class);
    }

     public function job(){
        $this->belongsTo(Job::class);
    }
}
