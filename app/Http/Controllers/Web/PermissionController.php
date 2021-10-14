<?php

namespace App\Http\Controllers\Web;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{

    protected $model;

    public function __construct(Permission $model)
    {
        $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
        $this->model = new Repository($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::get();
        return view('permission.index',compact('permission'));
    }

    public function getList(Request $request)
    {
        $orderableCols = ['created_at'];
        $searchableCols = ['name'];
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


    public function getPermission(Request $request)
    {
        $search = trim($request->search);

        $permission = Permission::where('name','LIKE','%'.$search.'%')->get();
        $formatted_permission = [];
        foreach ($permission as $p) {
            // print_r($p);
            // die;
            $formatted_permission[] = ['id' => $p->id, 'text' => $p->name];
        }

        return \Response::json($formatted_permission);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions',
        ]);

        try {
            $this->model->create($request->all());
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    //     // Permission::create(['name' => $request->name]);
    //     // return redirect()->back()
    //     //                 ->with('success','Permission Created successfully');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::where('id',$id)->get();
        return response($permission , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);

        try {
            $data = $request->all();
            $this->model->update($data , $permission);
            return response('Permission has been Updated Successfully',200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $this->model->delete($permission);
            return response('Permission Deleted Successfully',200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
