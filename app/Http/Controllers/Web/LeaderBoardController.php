<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\RouterService;
use App\Models\Goal;
use App\Repositories\StatRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LeaderBoardController extends Controller
{
    protected $model;

    public function __construct(Goal $model)
    {
        $this->model = new StatRepository($model);
        $this->router = 'leaderboard';
        $this->routerService = new RouterService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.leaderboard.index');
    }

    public function getList(Request $request) {
        try {
            $orderableCols = ['created_at', 'charity_id', 'title', 'image', 'description', 'actual_target','current_target','starting_date','ending_date','active','student_count',];
            $searchableCols = ['title'];
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
        catch(Exception $e) {

            Log::error($e);
        }

    }

    public function show($id)
    {
        $record = $this->model->show($id,['charity','charity.teacher','charity.classroom']);
        return view('admin.leaderboard.show',compact('record'));
    }

}
