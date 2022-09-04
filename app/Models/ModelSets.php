<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelSets extends Model
{
    use HasUser;
    protected $table = 'models';
    public function subjects() {
        return $this->belongsToMany('App\Models\Subject','model_sets_subject','model_id');
    }
    public function packages() {
        return $this->belongsToMany('App\Models\Package');
    }
}
