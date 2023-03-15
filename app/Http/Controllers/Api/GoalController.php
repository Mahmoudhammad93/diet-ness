<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\GoalCategory;
use Exception;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $user = userLogin();
            $goalCategories = GoalCategory::select([
                'id', app()->getLocale().'_name as name', 'image'
            ])
            ->get();
            return responseSuccess(trans('admin.Goal Categories') , $goalCategories);

        }catch(Exception $ex){
            return responseError($ex);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = userLogin();
            $request['user_id'] = $user->id;
            $goal = Goal::create($request->all());
            return responseSuccess(trans('admin.Operation Success'), $goal);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

}
