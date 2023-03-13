<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function terms()
    {
        try{
            $setting = Setting::first();
            return responseSuccess(trans('admin.Terms And Condition'),$setting->terms);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacy()
    {
        try{
            $setting = Setting::first();
            return responseSuccess(trans('admin.Terms And Condition'),$setting->privacy);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        try{
            $setting = Setting::first();
            return responseSuccess(trans('admin.About'),$setting->about);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        try{
            $setting = Setting::first();
            return responseSuccess(trans('admin.Contact'),$setting->contacts);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

}
