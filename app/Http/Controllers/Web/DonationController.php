<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\RouterService;
use App\Models\Donation;
use App\Repositories\DonationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    protected $model;

    public function __construct(Donation $model)
    {
        $this->model = new DonationRepository($model);
        $this->router = 'charities.index';
        $this->routerService = new RouterService();
    }

    public function index()
    {
        return view('admin.donation.index');
    }

    public function getList(Request $request) {
        try {
            $orderableCols = ['created_at'];
            $searchableCols = [];
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
}
