<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\RouterService;
use App\Models\Charity;
use App\Repositories\CharityRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CharityController extends Controller
{
    protected $model;

    public function __construct(Charity $model)
    {
        $this->middleware('permission:charity-list|charity-create|charity-edit|charity-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:charity-create', ['only' => ['create','store']]);
        $this->middleware('permission:charity-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:charity-delete', ['only' => ['destroy']]);
        $this->model = new CharityRepository($model);
        $this->router = 'charities.index';
        $this->routerService = new RouterService();
    }

    public function getList(Request $request) {
        try {
            $orderableCols = ['created_at',  'title', 'description', 'active','tag_line'];
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.charities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.charities.create');
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

    public function getCharity(Request $request)
    {
        $search = trim($request->search);

        $users = Charity::where('name','Like',"%".$search."%")->get();
        $formatted_depts = [];
        foreach ($users as $user) {
            $formatted_depts[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_depts);
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
