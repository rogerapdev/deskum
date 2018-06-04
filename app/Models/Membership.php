<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_memberships';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'team_id', 'admin',
    ];

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }

}
