<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Http\Requests\SecurityQuestionRequest;
use App\Models\SecurityQuestion;

class SecurityQuestionController extends Controller
{
    protected $model;

    public function __construct(SecurityQuestion $model)
    {
        // $this->middleware('permission:plan-list|plan-create|plan-edit|plan-delete', ['only' => ['index','show','getList']]);
        // $this->middleware('permission:SecurityQuestion-create', ['only' => ['create','store']]);
        // $this->middleware('permission:SecurityQuestion-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:SecurityQuestion-delete', ['only' => ['destroy']]);
        $this->model = new Repository($model);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(SecurityQuestionRequest $request)
    {
        try {
            if(!SecurityQuestion::where('user_id', auth()->id())->exists() ){
               $data = [
                   'mother_name' => strtoupper($request->mother_name),
                   'school_name' => strtoupper($request->school_name),
                   'friend_name' => strtoupper($request->friend_name),
                   'user_id' => auth()->id(),
               ];
               
               $response = $this->model->create($data);
               return response(['message'=>'Submitted Successfully!'],200);
            }
            return response(['message'=>'You already saved your answers!'],422);

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
