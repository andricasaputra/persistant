<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserFailedJobs extends Model
{
    protected $table = 'user_failed_jobs';

    protected $guarded = [];
}
