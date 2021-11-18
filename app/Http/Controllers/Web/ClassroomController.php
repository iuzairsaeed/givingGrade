<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;
use App\Http\Services\RouterService;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClassroomController extends Controller
{
    protected $model;

    public function __construct(Classroom $model)
    {
        // $this->middleware('permission:classroom-list|classroom-create|classroom-edit|classroom-delete', ['only' => ['index','show','getList']]);
        // $this->middleware('permission:classroom-create', ['only' => ['create','store']]);
        // $this->middleware('permission:classroom-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:classroom-delete', ['only' => ['destroy']]);
        $this->model = new ClassroomRepository($model);
        $this->router = 'classrooms.index';
        $this->routerService = new RouterService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.classrooms.index');
    }

    public function getList(Request $request) {
        try {
            $orderableCols = ['created_at',  'title', 'description', 'active','name'];
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

    public function teacherClassroom()
    {
        return view('admin.teacher_classrooms.index');
    }

    public function getTeacherClassroomList(Request $request) {
        try {
            $orderableCols = ['created_at',  'title', 'description', 'active','name'];
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
        return view('admin.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassroomRequest $request)
    {
        $data = $request->validated();
        $message = 'Record successfully created.';
        $error = false;
        try {

            $this->model->create($data);
        } catch (\Exception $e) {

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
        return view('admin.classrooms.show', compact('record'));
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
        return view('admin.classrooms.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassroomRequest $request, $id)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            $record = $this->model->show($id);
            $this->model->update($data,$record);
        } catch (\Exception $e) {
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
        //
    }
}
