<?php

namespace App\Http\Controllers\Api;

use App\Criteria\Api\TicketCriteria;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepository;
use App\Transformers\TicketTransformer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class TicketController extends Controller
{

    /**
     * @var TicketRepository
     */
    protected $repository;

    public function __construct(TicketRepository $repository = null)
    {

        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->repository->pushCriteria(new TicketCriteria);
        $tickets = $this->repository->paginate(env('PER_PAGE'));

        return TicketResource::collection($tickets);

        // $tickets = $this->repository->paginate();
        $links = str_replace('/?', '?', $tickets->render());

        $tickets = $this->respondWithPagination($tickets, (new TicketTransformer)->transformCollection($tickets)->toArray());

        // $tickets = (new TicketTransformer)->transformCollection($tickets);
        return response()->json($links);
    }

    /**
     * @param Paginator $paginate
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $paginate, $data)
    {

        return array_merge($data, [
            'paginator' => [
                'total_count' => $paginate->total(),
                'total_pages' => ceil($paginate->total() / $paginate->perPage()),
                'current_page' => $paginate->currentPage(),
                'limit' => $paginate->perPage(),
            ],
        ]);

    }

}
