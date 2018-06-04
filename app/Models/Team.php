<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'token',
    ];

    public static function findByToken($token)
    {
        return self::where('token', $token)->firstOrFail();
    }
    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships')->withPivot('admin');
    }
    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function leads()
    {
        return $this->hasMany(Lead::class);
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

    public static function membersByTeam()
    {
        return [__('team.none') => [null => '--']] + self::all()->mapWithKeys(function ($team) {
            return [$team->name => $team->members->pluck('name', 'id')->toArray()];
        })->toArray();
    }
}
