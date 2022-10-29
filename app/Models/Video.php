<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    // Insert the current user data while saving date
    use HasUser;
}
