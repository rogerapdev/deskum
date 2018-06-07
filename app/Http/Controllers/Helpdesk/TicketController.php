<?php

namespace App\Http\Controllers;

use App\Criteria\Filters\TicketCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\TicketRequest;
use App\Repositories\TicketRepository;
use Dependency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
    public function index()
    {

        $optionsStatus = Dependency::optionsRepository('App\Repositories\TicketRepository', 'optionsStatus');
        $colorsStatus = Dependency::optionsRepository('App\Repositories\TicketRepository', 'colorsStatus');
        $optionsPriority = Dependency::optionsRepository('App\Repositories\TicketRepository', 'optionsPriority');
        $colorsPriority = Dependency::optionsRepository('App\Repositories\TicketRepository', 'colorsPriority');

        $this->repository->pushCriteria(new TicketCriteria);
        $tickets = $this->repository->paginate(env('PER_PAGE'));
        $links = str_replace('/?', '?', $tickets->render());

        return view('helpdesk.tickets.index', compact('tickets', 'links', 'optionsStatus', 'colorsStatus', 'optionsPriority', 'colorsPriority'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = $this->repository->find($id);

        return view('helpdesk.tickets.show', compact('ticket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $ticket = $this->repository->makeModel();

        return view('helpdesk.tickets.form', compact('ticket'));
    }

    /**
     * Show the form for editing the given resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $ticket = $this->repository->find($id);

        return view('helpdesk.tickets.form', compact('ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {

        // dd($request->all());

        try {

            $ticket = $this->repository->create($request->all());
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('tickets');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, $id)
    {
        try {

            $this->repository->update($request->all(), $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('tickets');
    }

    /**
     * Delete the given resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->repository->delete($id);
        } catch (Exception $e) {
            return back();
        }

        return redirect('tickets');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function comment(CommentRequest $request, $id)
    {

        // dd($request->all());

        try {

            $this->repository->commentAndNotify($request->all(), $id);

        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('tickets');
    }

    /**
     * Print listing
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function listing(Request $request, ...$args)
    {

        if ($request->isMethod('GET')) {

            return view('helpdesk.tickets.reports.listing.index');
        }

        $this->repository->pushCriteria(new TicketCriteria);
        $tickets = $this->repository->all();

        $report_content = View::make('helpdesk.tickets.reports.listing.print')
            ->with('report_title', 'Listagem de Usuários')
            ->with('report_data', $tickets)->render();

        $report = app('App\Services\Report');

        return $report->generate($report_content, 'report', 'pdf');

    }
}
