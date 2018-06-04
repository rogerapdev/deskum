<?php namespace App\Repositories;

use App\Repositories\Repository;

class ProjectRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "App\Models\Project";
    }

}
