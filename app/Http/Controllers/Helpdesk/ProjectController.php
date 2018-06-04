<?php

namespace App\Http\Controllers;

use App\Criteria\Filters\ProjectCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Repositories\ProjectRepository;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    protected $repository;

    public function __construct(ProjectRepository $repository = null)
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

        $this->repository->pushCriteria(new ProjectCriteria);
        $projects = $this->repository->paginate(env('PER_PAGE'));
        $links = str_replace('/?', '?', $projects->render());

        return view('helpdesk.projects.index', compact('projects', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $project = $this->repository->makeModel();

        return view('helpdesk.projects.form', compact('project'));
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

        $project = $this->repository->find($id);

        return view('helpdesk.projects.form', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        try {

            $data = $request->all();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $data['disabled'] = (isset($data['disabled']) and $data['disabled']) ? 1 : 0;

            // dd($data);

            $project = $this->repository->create($data);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('projects');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        try {

            $data = $request->all();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $data['disabled'] = (isset($data['disabled']) and $data['disabled']) ? 1 : 0;

            $this->repository->update($data, $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('projects');
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

        return redirect('projects');
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

            return view('helpdesk.projects.reports.listing.index');
        }

        $this->repository->pushCriteria(new ProjectCriteria);
        $projects = $this->repository->all();

        $report_content = View::make('helpdesk.projects.reports.listing.print')
            ->with('report_title', 'Listagem de Usuários')
            ->with('report_data', $projects)->render();

        $report = app('App\Services\Report');

        return $report->generate($report_content, 'report', 'pdf');

    }
}
