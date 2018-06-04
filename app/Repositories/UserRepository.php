<?php namespace App\Repositories;

use App\Repositories\Repository;

class UserRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\Models\User";
    }

}
