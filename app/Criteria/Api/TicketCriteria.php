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

            if ($request->has('requester')) {
                if ($request->has('requester.name') and $request->input('requester.name')) {
                    $query->where('name', $request->input('requester.name'));
                }

                if ($request->has('requester.email') and $request->input('requester.email')) {
                    $query->where('email', $request->input('requester.email'));
                }

                if ($request->has('external_id') and $request->input('requester.external_id')) {
                    $query->where('external_id', $request->input('requester.external_id'));
                }

            }

        });

        // http://deskum.escolarisy.local/api/tickets?page=2&requester[name]=rogerio&requester[email]=rogerapras@gmail.com
        // http://deskum.escolarisy.local/api/tickets?page=2&requester=name:rogerio,email:rogerapras@gmail.com

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
