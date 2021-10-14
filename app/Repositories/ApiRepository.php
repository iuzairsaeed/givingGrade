<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use DB;

class ApiRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all(array $with = [])
    {
        return $this->model->with($with)->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, Model $model)
    {
        return $model->update($data);
    }

    // remove record from the database
    public function delete(Model $model)
    {
        return $model->delete();
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    // Sort the records by priority
    public function sort(array $order)
    {
        foreach($order as $priority => $id){
            $data = ['priority' => $priority + 1];
            $this->update($data, $id);
        }
    }

    // Get data for Api
    public function getData($request, $with, $withTrash, $withCount, $whereHas, $withSums, $withSumsCol, $addWithSums, $whereChecks, $whereOps, $whereVals, $searchableCols, $orderableCols, $currentStatus)
    {
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        $filter = $request->search;
        $order = $request->order;
        $search = optional($filter)['value'] ?? 0;
        $sort = optional($order)[0]['column'] ?? 0;
        $dir = optional($order)[0]['dir'] ?? 0;
        $from = $request->date_from;
        $to = $request->date_to;

        $records = $this->model->with($with)->withCount($withCount);

        if($whereHas){
            $records->has($whereHas);
        }
        if($currentStatus){
            $records->currentStatus($currentStatus);
        }
        if($withSums){
            foreach($withSums as $key => $withSum){
                $records->withCount([
                    $withSum.' AS '.$withSum.'_sum' => function ($query) use ($withSumsCol, $key) {
                        $query->select(DB::raw('SUM('.$withSumsCol[$key].')'));
                    }
                ]);
                if(optional($addWithSums)[$key]){
                    $records->withCount([
                        $withSum.' AS '.$withSum.'_'.$addWithSums[$key].'_sum' => function ($query) use ($withSumsCol, $key, $addWithSums) {
                            $query->select(DB::raw('SUM('.$withSumsCol[$key].') + '.$addWithSums[$key]));
                        }
                    ]);
                }
            }
        }
        if($whereChecks){
            foreach($whereChecks as $key => $check){
                $records->where($check, $whereOps[$key] ?? '=', $whereVals[$key]);
            }
        }
        $recordsTotal = $records->count();

        if($from){
            $records->whereDate('created_at' ,'>=', $from);
        }
        if($to){
            $records->whereDate('created_at' ,'<=', $to);
        }

        if($search){
            $records->where(function($query) use ($searchableCols, $search){
                foreach($searchableCols as $col){
                    $query->orWhere($col, 'like' , "%$search%");
                }
            });
        }

        if($dir){
            if(in_array($sort, $orderableCols)){
                $orderBy = $sort;
            }else{
                $orderBy = $orderableCols[$sort];
            }
            $records->orderBy($orderBy, $dir);
        }else{
            $records->latest();
        }

        if($withTrash){
            $records->withTrashed();
        }

        $recordsFiltered = $records->count();
        $records = $records->limit($length)->offset($start)->get();
        $message = 'Success';
        $response = 200;
        if($records->count() == 0){
            $message = 'No data available.';
            $response = 404;
        }

        #store in cache
        Cache::put('data', $records, now()->addMinutes(2));

        return [
            'message' => $message,
            'response' => $response,
            'recordsTotal' => $recordsTotal,
            'data' => $records,
        ];
    }
}
