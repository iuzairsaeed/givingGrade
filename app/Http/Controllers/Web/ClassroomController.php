<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\RouterService;
use App\Models\Classroom;
use App\Repositories\ClassroomRepository;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    protected $model;

    public function __construct(Classroom $model)
    {
        $this->model = new ClassroomRepository($model);
        $this->router = 'subjects.index';
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
