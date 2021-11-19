<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\{ChangePasswordRequest,ProfileUpdateRequest};
use App\Http\Requests\TeacherProfileRequest;
use App\Http\Services\RouterService;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = new UserRepository($model);
        $this->router = 'profile';
        $this->routerService = new RouterService();
    }
    public function showTeacherProfileForm()
    {
        $user = $this->model->show(auth()->user()->id,['subjects:id']);
        return view('auth.teacher_profile', compact('user'));
    }

    public function showProfileForm()
    {
        $user = $this->model->show(auth()->user()->id);
        return view('auth.profile', compact('user'));
    }

    public function teacherProfile(TeacherProfileRequest $request)
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
        return $this->routerService->redirect('teacher.profile', $error, $message);
    }

    public function profile(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $message = 'Profile successfully updated.';
        $error = false;
        try {
            $user = $this->model->show(auth()->user()->id);
            extract($data);
            $user->name = $name;
            $user->email = $email;
            $user->dob = $dob;

            if($imageRemove ==1) {
                $file = $avatar;
                Storage::disk('user_profile')->deleteDirectory('users/' .$user->id);
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filePath = "users/".$user->id.'/' . $fileName . time() . "." . $file->getClientOriginalExtension();
                $store = Storage::disk('user_profile')->put( $filePath, file_get_contents($file));
                $user->avatar = $filePath;
            }
            $user->save();
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
        $data = $request->validated();
        $message = 'Password Has Been updated.';
        $error = false;
        try {
            $user = $this->model->show(auth()->user()->id);
            $user->password = Hash::make($request->password);
            $user->update();
        } catch (\Exception $e) {
            $error = true;
            $message = $e->getMessage();
            Log::error($e);
        }
        return $this->routerService->redirectBack($error, $message);
    }
}
