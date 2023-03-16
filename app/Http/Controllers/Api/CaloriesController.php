<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calory;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class CaloriesController extends Controller
{
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $user = userLogin();
        $calories = Calory::where('user_id', $user->id)->get();
        return responseSuccess(trans('web.success'), $calories);
    }

    public function update(Request $request)
    {
        try{
            $calory = Calory::where('id', $request->id)->first();
            if($calory){
                $curruntDate = date('m/d/Y');
                $date = Carbon::createFromFormat('m/d/Y', $curruntDate);
                $day = $date->format('D'); // Current day name

    
                $calory->update([
                    'total' => $request->total,
                    'day' => $day,
                    'date' => $date->format('d-m-Y')
                ]);
    
                return responseSuccess(trans('admin.Updated Success'), $calory);
            }else{
                return response()->json([
                    'message' => 'Calory Not Found'
                ]);
            }
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

}
