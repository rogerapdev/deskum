<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id', 'user_id', 'new_status', 'private', 'body',
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
