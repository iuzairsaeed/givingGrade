<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Repository;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
