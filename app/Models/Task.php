<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lead_id', 'user_id', 'body', 'datetime', 'completed',
    ];

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
