<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\ProfileUpdateRequest;
use App\Http\Requests\Auth\AvatarUpdateRequest;
use App\Http\Requests\Auth\PinUpdateRequest;
use App\Http\Requests\Auth\BiometricUpdateRequest;
use App\Http\Requests\Auth\Update2faRequest;
use App\Notifications\TwoFactorNotification;
use App\Repositories\Repository;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = new Repository($model);  
    }

    function updateProfile(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $user->update($request->all());

        $user['status_warning'] = $user->status == CompleteProfile() ? $user->setStatus(ApprovalPending()) : $user->status;

        return response([
            'message' => 'Profile has been updated.',
            'user' => $user
        ], 200);
    }

    function updateBiometric(BiometricUpdateRequest $request){
        try {
            $user = auth()->user();
            $user->biometric = $request->biometric;
            $user->update();
            return response([
                'message' => 'Biometric has been added.',
            ], 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    function updatePin(PinUpdateRequest $request){
        try {
            $user = auth()->user();
            $user->pin = Hash::make($request->pin);
            $user->update();
            return response([
                'message' => 'Pin has been added.',
            ], 200);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    function update2FA(Request $request){
        try {

            // Save OTP in DB
            $user = auth()->user();
            $code = rand ( 10000 , 99999 );
            $user->two_factor_code = $code;
            $user->update();

            // send email to user
            $user->notify(new TwoFactorNotification($code));

            return response([
                'message' => 'An email has been sent to your account with new password. (If you cannot find Check in Spam/Junk)'
            ], 200);

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    
    function verify2fa(Update2faRequest $request){
        try {
            $user = auth()->user();

            if ($user->two_factor_code == $request->code){
                $user->two_factor = true;
                $user->update();
                return response(['message' => '2FA has been varified.',], 200);
            } 
            return response([ 'message' => 'OTP Code is not valid.'], 404);
           
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    function updateAvatar(AvatarUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();

        if($request->hasFile('avatar')){
            $deleteFile = $user->getAttributes()['avatar'] != 'no-image.png' ? $user->avatar : null;
            $file_name = uploadFile($request->avatar, avatarsPath(), $deleteFile);
            $user->avatar = $file_name;
        }
        $user->update();

        return response([
            'message' => 'Avatar has been updated.',
            'avatar' => avatarsPath().$file_name
        ], 200);
    }

    public function getAllUsers() {
        $data = User::where('is_dummy', true)->get(['name','username']);
        collect($data)->map(function ($item) {
            $item['pass'] = 'secret';
        });
        return response($data, 200);
    }
}
