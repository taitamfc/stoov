<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoalTracking extends Model
{
    protected $fillable = [
        'company_id',
        'goal_type_id',
        'subject',
        'target_achievement',
        'description',
        'start_date',
        'end_date',
        'progress',
        'status',
        'is_active',
    ];

    public function company(){
        return $this->hasOne('App\Company','id','company_id');
    }

    public function goalType(){
        return $this->hasOne('App\GoalType','id','goal_type_id');
    }
}
