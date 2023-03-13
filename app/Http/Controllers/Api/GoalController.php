<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

            $goals = collect([
                (object)[
                    'id' => 1,
                    'image' => "",
                    'name' => "Lose Weight",
                ],
                (object)[
                    'id' => 1,
                    'image' => "",
                    'name' => "Build Muscles",
                ],
                (object)[
                    'id' => 1,
                    'image' => "",
                    'name' => "Be Healther",
                ],
            ]);
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
            return responseSuccessMessage(trans('admin.Operation Success'));
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

}
