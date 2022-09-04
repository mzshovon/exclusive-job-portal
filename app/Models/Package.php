<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasUser;
    public function model_sets() {
        return $this->belongsToMany('App\Models\ModelSets');
    }
}
