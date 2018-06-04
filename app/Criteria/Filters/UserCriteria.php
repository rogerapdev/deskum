<?php namespace App\Criteria\Filters;

use Illuminate\Support\Facades\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyCriteria
 * @package namespace App\Criteria;
 */
class UserCriteria implements CriteriaInterface
{

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $request = Request::instance();

        if ($request->has('name') and $request->get('name')) {
            $model = $model->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if (count($request->all()) > 0) {
            session()->flash('filters', $request->all());
        } else if (session()->has('filters')) {
            session()->forget('filters');
        }

        return $model;
    }
}
