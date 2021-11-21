<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CharityRequest;
use App\Http\Services\RouterService;
use App\Models\{Charity,Donation};
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
    public function store(CharityRequest $request)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            // $record = $this->model->show($id);
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
        return view('admin.charities.show', compact('record'));
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
        return view('admin.charities.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CharityRequest $request, $id)
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

    public function getCharity(Request $request)
    {
        $search = trim($request->search);
        $users = collect();
        if(auth()->user()->roles->first()->name == config('constant.role.teacher')) {
            $users = Charity::where('title','Like',"%".$search."%")->where('user_id',auth()->user()->id)->get();
        }
        else {
            $users = Charity::where('name','Like',"%".$search."%")->get();
        }
        $formatted_depts = [];
        foreach ($users as $user) {
            $formatted_depts[] = ['id' => $user->id, 'text' => $user->title];
        }

        return \Response::json($formatted_depts);
    }

    public function donateCharities(Request $request)
    {
        $records = $this->model->all(['teacher','classroom','goal']);
        return view('admin.sponsor_charity.index',compact('records'));
    }

    public function donateCharity($id,Request $request)
    {
        $validatedData = $request->validate([
            'donation' => 'required|lte:target',
        ]);
        extract($validatedData);
        $record = $this->model->show($id,['goal']);
        Donation::create(['user_id' => auth()->user()->id , 'charity_id' => $id,'amount' => $donation]);
        return response($record , 200);
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
