<?php namespace App\Criteria\Api;

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

        $model = $model->whereHas('requester', function ($query) use ($request) {
            $query->where('client_token', $request->header('X-Client-Token'));

            if ($request->has('external_id') and $request->get('external_id')) {
                $query->where('external_id', $request->get('external_id'));
            }
        });

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
