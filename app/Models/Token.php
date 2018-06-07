<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hk_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_token', 'client_token', 'email',
    ];

}
