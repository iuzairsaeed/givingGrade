<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Repositories\Repository;
use App\Http\Requests\CitizenRequest;
use App\Models\Citizen;

class CitizenController extends Controller
{
    protected $model;

    public function __construct(Citizen $model)
    {
        // $this->middleware('permission:citizen-list|citizen-create|citizen-edit|citizen-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:citizen-create', ['only' => ['create','store']]);
        // $this->middleware('permission:citizen-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:citizen-delete', ['only' => ['destroy']]);
        $this->model = new Repository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Citizen $request)
    {
        $orderableCols = [];
        $searchableCols = [];
        $whereChecks = ['user_id'];
        $whereOps = ['='];
        $whereVals = [auth()->id()];
        $with = [];
        $withCount = [];
        $currentStatus = [];
        $withSums = [];
        $withSumsCol = [];
        $addWithSums = [];
        $whereHas = null;
        $withTrash = false;

        $data = $this->model->getDataApi($request, $with, $withTrash, $withCount, $whereHas, $withSums, $withSumsCol, $addWithSums, $whereChecks,
                                        $whereOps, $whereVals, $searchableCols, $orderableCols, $currentStatus);
                                    
        return response($data, 200);
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
    public function store(CitizenRequest $request)
    {
        try {
            $data = $request->except(['step_no']);
            $citizen = $this->model->all()->where('user_id',auth()->id())->first();
            if(!$citizen || $citizen->country != $request->country){
                $data["user_id"] = auth()->id();
                if(auth()->user()->status == CompleteProfile()){
                    return response(['message'=>'Please complete your profile first!'],404);
                }
                $response = $this->model->create($data);
                $response->setStatus(PendingRegistration());
                return response([
                    'message'=>'Submitted Successfully!',
                    'data'=>$response
                ],200);
            }
            return response(['message'=>'you cannot register the same country!'],404);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
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
    public function update(CitizenRequest $request, Citizen $citizen)
    {
        try {
            $data = $request->all();
            if($request->hasFile('nic_scan')){
                $deleteFile = $citizen->getAttributes()['nic_scan'] != 'no-image.png' ? $citizen->nic_scan : null;
                $file_name = uploadFile($request->nic_scan, nicPath(), $deleteFile);
                $data['nic_scan'] = $file_name;
            }
            if($request->hasFile('passport_scan')){
                $deleteFile = $citizen->getAttributes()['passport_scan'] != 'no-image.png' ? $citizen->passport_scan : null;
                $file_name = uploadFile($request->passport_scan, passportPath(), $deleteFile);
                $data['passport_scan'] = $file_name;
            }
            if($request->hasFile('bill_scan')){
                $deleteFile = $citizen->getAttributes()['bill_scan'] != 'no-image.png' ? $citizen->bill_scan : null;
                $file_name = uploadFile($request->bill_scan, billPath(), $deleteFile);
                $data['bill_scan'] = $file_name;
            }
    
            $this->model->update($data, $citizen);
            $citizen->setStatus(PendingRegistration());
            if($request->hasFile('nic_scan') && $request->hasFile('passport_scan') && $request->hasFile('bill_scan' )){
                $citizen->setStatus(PendingApproval());
            }
            return response(['message'=>'Submitted Successfully!'],200);
        } catch (\Exception $th) {
            return $th->getMessage();
        }
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
