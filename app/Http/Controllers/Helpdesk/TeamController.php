<?php

namespace App\Http\Controllers;

use App\Criteria\Filters\TeamCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TeamController extends Controller
{

    /**
     * @var TeamRepository
     */
    protected $repository;

    public function __construct(TeamRepository $repository = null)
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

        $this->repository->pushCriteria(new TeamCriteria);
        $teams = $this->repository->paginate(env('PER_PAGE'));
        $links = str_replace('/?', '?', $teams->render());

        return view('helpdesk.teams.index', compact('teams', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $team = $this->repository->makeModel();

        return view('helpdesk.teams.form', compact('team'));
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

        $team = $this->repository->find($id);

        return view('helpdesk.teams.form', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {

        try {

            $team = $this->repository->create($request->all());
            $this->repository->syncMemberships($request->get('memberships'), $team->id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('teams');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        // dd($request->all());
        try {

            $this->repository->update($request->all(), $id);
            $this->repository->syncMemberships($request->get('memberships'), $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('teams');
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

        return redirect('teams');
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

            return view('helpdesk.teams.reports.listing.index');
        }

        $this->repository->pushCriteria(new TeamCriteria);
        $teams = $this->repository->all();

        $report_content = View::make('helpdesk.teams.reports.listing.print')
            ->with('report_title', 'Listagem de Usuários')
            ->with('report_data', $teams)->render();

        $report = app('App\Services\Report');

        return $report->generate($report_content, 'report', 'pdf');

    }
}
