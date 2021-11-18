<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\{ChangePasswordRequest,ProfileUpdateRequest};
use App\Http\Services\RouterService;
use App\Models\User;
use App\Repositories\UserRepository;
use Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = new UserRepository($model);
        $this->router = 'profile';
        $this->routerService = new RouterService();
    }
    public function showProfileForm()
    {
        $user = $this->model->show(auth()->user()->id,['subjects:id']);
        return view('auth.profile', compact('user'));
    }

    public function profile(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $message = 'Profile successfully updated.';
        $error = false;
        try {
            $user = $this->model->show(auth()->user()->id);
            $this->model->update($data,$user);
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }

        if($error)
            return $this->routerService->redirectBack($error, $message);
        return $this->routerService->redirect($this->router, $error, $message);
    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('success', 'Password has been updated.');
    }
}
