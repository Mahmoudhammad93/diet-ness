<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Goal;
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
            $goals = Goal::where('user_id', $user->id)
            ->select([
                'id', 'name', 'last_weight', 'goal_weight', 'sex', 'birthdate', 'user_id'
            ])
            ->get();
            return responseSuccess(trans('admin.Goals') , $goals);

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
