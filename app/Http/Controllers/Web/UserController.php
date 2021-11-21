<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Customer;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\RouterService;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->model = new UserRepository($model);
        $this->router = 'users.index';
        $this->routerService = new RouterService();
    }

    public function getList(Request $request)
    {
        $orderableCols = ['created_at', 'name', 'email','dob','students','school','gender','grade_level','is_active'];
        $searchableCols = ['name', 'email'];
        $whereChecks = ['id'];
        $whereOps = ['<>'];
        $whereVals = [auth()->id()];
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

    public function getUser(Request $request)
    {
        $search = trim($request->search);

        $users = User::where('name','Like',"%".$search."%")->get();
        $formatted_depts = [];
        foreach ($users as $user) {
            $formatted_depts[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_depts);
    }

    public function getTeacher(Request $request)
    {
        $search = trim($request->search);

        $users = User::whereHas('roles',function($query) {
            $query->where('id',2);
        })->where('name','Like',"%".$search."%")->where('is_active',1)->get();
        $formatted_depts = [];
        foreach ($users as $user) {
            $formatted_depts[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_depts);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = $this->model->show($id,['roles']);
        // dd($record);
        return view('admin.users.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->model->show($id,['roles:id']);
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(RegisterRequest $request, $id)
    {
        $data = $request->validated();
        $message = 'Record successfully updated.';
        $error = false;
        try {
            extract($data);
            $user = User::find($id);
            $user->name =$name;
            $user->email =$email;
            $user->password = bcrypt($password);
            $user->dob =$dob;
            if($roles == 1) {
                $user->is_admin = 1;
            }
            $user->is_active =$status;
            $user->save();
            $user->syncRoles([$roles]);
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
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model->show($id);
        $this->model->delete($record);
        auth()->logout();
        return redirect('login');
    }
}
