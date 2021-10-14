<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Customer;
use App\Http\Requests\Auth\RegisterRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show','getList']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        $this->model = new UserRepository($model);
    }

    public function getList(Request $request)
    {
        $orderableCols = ['created_at', 'name', 'username', 'email', 'is_premium', 'is_active'];
        $searchableCols = ['name', 'username', 'email'];
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $user = $this->model->create($request->all());
        $user->assignRole($request->input('roles'));
        return redirect('users')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.show', compact('user','roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'is_active' => 'required|boolean',
            'roles' => 'required'
        ]);
        $this->model->update($request->only($this->model->getModel()->fillable), $user);
        $user->syncRoles($request->input('roles'));
        // $updateUser->assignRole();

        return redirect('users')->with('success', 'User updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->model->delete($user);

        // return redirect('users')->with('success', 'User deleted successfully');
    }
}
