<?php namespace App\Criteria\Filters;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class MyCriteria
 * @package namespace App\Criteria;
 */
class TicketCriteria implements CriteriaInterface
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

        $model = $model->orderBy(DB::raw('FIELD(status, "open", "pending", "new", "solved", "closed", "merged", "spam")'))
            ->orderBy(DB::raw('FIELD(priority, "urgent", "high", "medium", "low")'))
            ->orderBy('id', 'asc');

        if (count($request->all()) > 0) {
            session()->flash('filters', $request->all());
        } else if (session()->has('filters')) {
            session()->forget('filters');
        }

        return $model;
    }
}
