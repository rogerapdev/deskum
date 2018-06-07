<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    const STATUS_NEW = 1;
    const STATUS_OPEN = 2;
    const STATUS_PENDING = 3;
    const STATUS_SOLVED = 4;
    const STATUS_CLOSED = 5;
    const STATUS_MERGED = 6;
    const STATUS_SPAM = 7;
    const PRIORITY_LOW = 1;
    const PRIORITY_NORMAL = 2;
    const PRIORITY_HIGH = 3;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body', 'public_token', 'requester_id', 'project_id', 'team_id', 'user_id', 'status', 'priority', 'level',
    ];

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function requester()
    {
        return $this->belongsTo('App\Models\Requester', 'requester_id', 'id');
    }

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id', 'id');
    }

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
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id', 'id');
    }

    /**
     * A state may have multiple cities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'ticket_id', 'id');
    }

}
