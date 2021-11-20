<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\{User,Goal,Classroom,Subject,Charity};
use Illuminate\Http\Request;
use App\Repositories\Repository;

class DashboardController extends Controller
{
    public function index()
    {
        $user = new User();
        $goal = new Goal();
        $charity = new Charity();
        $classroom = new Classroom();
        $subject = new Subject();
        $data['teachers'] = $user->whereHas('roles',function($q) {
                                $q->where('id',2);
                            })->where('is_active',1)->count();
        $data['sponsors'] = $user->whereHas('roles',function($q) {
                                $q->where('id',3);
                            })->where('is_active',1)->count();
        $data['goals'] = auth()->user()->roles->first()->name == config('constant.role.teacher') ? $goal->where('active',1)->where('user_id',auth()->user()->id)->count() :  $goal->where('active',1)->count();
        $data['charities'] = auth()->user()->roles->first()->name == config('constant.role.teacher') ? $charity->where('active',1)->where('user_id',auth()->user()->id)->count() :  $charity->where('active',1)->count();
        $data['classrooms'] = auth()->user()->roles->first()->name == config('constant.role.teacher') ? $classroom->where('active',1)->where('user_id',auth()->user()->id)->count() :  $classroom->where('active',1)->count();
        $data['subjects'] = auth()->user()->roles->first()->name == config('constant.role.teacher') ? $subject->whereHas('users',function($q) {
                                                                                                        $q->where('user_id',auth()->user()->id);
                                                                                                    })->where('active',1)->count() : $subject->where('active',1)->count();
        $data['funds'] = config('constant.role.teacher') ? $goal->where('active',1)->where('user_id',auth()->user()->id)->sum('current_target') :  $goal->where('active',1)->sum('current_target');
        return view('admin.dashboard',compact('data'));
    }
}
