<?php namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class Repository extends BaseRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "";
    }

    public function makeModelWith()
    {
        return $this->makeModel();
    }

}
