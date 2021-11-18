<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\GoalRequest;
use App\Http\Services\RouterService;
use App\Models\Goal;
use App\Repositories\GoalRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Log};

class GoalController extends Controller
{
    protected $model;

    public function __construct(Goal $model)
    {
        $this->model = new GoalRepository($model);
        $this->router = 'goals.index';
        $this->routerService = new RouterService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.goals.index');
    }

    public function getList(Request $request) {
        try {
            $orderableCols = ['created_at', 'charity_id', 'title', 'image', 'description', 'actual_target','current_target','starting_date','ending_date','active','student_count'];
            $searchableCols = ['title'];
            $whereChecks = [];
            $whereOps = [];
            $whereVals = [];
            $with = [];
            $withCount = [];

            $data = $this->model->getData($request, $with, $withCount, $whereChecks, $whereOps, $whereVals, $searchableCols, $orderableCols);

            $serial = ($request->start ?? 0) + 1;
            collect($data['data'])->map(function ($item) use (&$serial) {
                $item['serial'] = $serial++;
                return $item;
            });
            return response($data, 200);
        }
        catch(Exception $e) {
            Log::error($e);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoalRequest $request)
    {
        $data = $request->validated();
        $message = 'Record successfully created.';
        $error = false;
        try {
            $this->model->create($data);
        } catch (\Exception $e) {
            dd($e);
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        if($error)
            return $this->routerService->redirectBack($error, $message);
        return $this->routerService->redirect($this->router, $error, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->model->show($id);
        return view('admin.goals.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->model->show($id);
        return view('admin.goals.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GoalRequest $request, $id)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            $record = $this->model->show($id);
            $this->model->update($data,$record);
        } catch (\Exception $e) {
            dd($e);
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        if($error)
            return $this->routerService->redirectBack($error, $message);
        return $this->routerService->redirect($this->router, $error, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $error = false;
        try {
            $message = 'Record successfully deleted';
            $record = $this->model->show($id);
            $this->model->delete($record);
        }
        catch (Exception $e) {
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }
        return $this->routerService->redirectBack($error, $message);
    }
}
