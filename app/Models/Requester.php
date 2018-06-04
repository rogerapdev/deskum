<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requester extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_requesters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }
    public function openTickets()
    {
        return $this->tickets()->where('status', '<', Ticket::STATUS_SOLVED);
    }
    public function solvedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_SOLVED);
    }
    public function closedTickets()
    {
        return $this->tickets()->where('status', '=', Ticket::STATUS_CLOSED);
    }
}
