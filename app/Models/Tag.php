<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function ticket()
    {
        return $this->morphedByMany('App\Models\Ticket', 'taggable');
    }

    /**
     * Get the employee that owns the user.
     * @return collection
     */
    public function leads()
    {
        return $this->morphedByMany('App\Models\Lead', 'taggable');
    }
}
