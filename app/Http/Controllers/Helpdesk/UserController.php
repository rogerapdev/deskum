<?php

namespace App\Http\Controllers;

use App\Criteria\Filters\UserCriteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository = null)
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

        $this->repository->pushCriteria(new UserCriteria);
        $users = $this->repository->paginate(env('PER_PAGE'));
        $links = str_replace('/?', '?', $users->render());

        return view('helpdesk.users.index', compact('users', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = $this->repository->makeModel();

        return view('helpdesk.users.form', compact('user'));
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

        $user = $this->repository->find($id);

        return view('helpdesk.users.form', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {

            $data = $request->all();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $data['admin'] = (isset($data['admin']) and $data['admin']) ? 1 : 0;
            $data['assistant'] = (isset($data['assistant']) and $data['assistant']) ? 1 : 0;

            // dd($data);

            $user = $this->repository->create($data);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('users');
    }

    /**
     * Update the given resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {

            $data = $request->all();
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $data['admin'] = (isset($data['admin']) and $data['admin']) ? 1 : 0;
            $data['assistant'] = (isset($data['assistant']) and $data['assistant']) ? 1 : 0;

            $this->repository->update($data, $id);
        } catch (Exception $e) {
            return back()->withInput();
        }

        return redirect('users');
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

        return redirect('users');
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

            return view('helpdesk.users.reports.listing.index');
        }

        $this->repository->pushCriteria(new UserCriteria);
        $users = $this->repository->all();

        $report_content = View::make('helpdesk.users.reports.listing.print')
            ->with('report_title', 'Listagem de Usuários')
            ->with('report_data', $users)->render();

        $report = app('App\Services\Report');

        return $report->generate($report_content, 'report', 'pdf');

    }
}
