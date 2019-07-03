<?php

namespace App\Http\Controllers\Api;

use App\Criteria\Api\TicketCriteria;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Repositories\TicketRepository;
use Illuminate\Http\Request;

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
        // $tickets = $this->repository->paginate(1);

        return TicketResource::collection($tickets);

    }

}
