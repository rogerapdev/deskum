<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TicketRepository;
use App\Transformers\TicketTransformer;
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
        $tickets = $this->repository->paginate(env('PER_PAGE'));

        $tickets = (new TicketTransformer)->transformCollection($tickets);
        return response()->json($tickets);
    }
}
