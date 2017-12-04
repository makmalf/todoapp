<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Http\Requests\CuTask;
use App\Task;

class TaskController extends Controller
{
	public function __construct(TaskRepository $taskRepository) {
		$this->middleware('auth');
		$this->taskRepository = $taskRepository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user_id = Auth::user()->id;
        $filter = $request->get('is_completed');

        if(isset($filter)) {
            $tasks = $this->taskRepository->findFiltered($user_id, intval($filter));
        } else {
    	   $tasks = $this->taskRepository->findByUserId($user_id);
        }

    	return $tasks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CuTask $request)
    {
        //
        $user_id = Auth::user()->id;
        $params = $request->all();

        return $this->taskRepository->store($user_id, $params);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CuTask $request, $id)
    {
        //
        $user_id = Auth::user()->id;
        $params = $request->all();

        return $this->taskRepository->update($user_id, $id, $params);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user_id = Auth::user()->id;

        return $this->taskRepository->destroy($user_id, $id);
    }
}
