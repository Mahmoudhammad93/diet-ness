<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\Package\PackagesResource;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $packages = PackagesResource::collection(Package::with('plan.meals.image')->paginate(20));
            $result = new \stdClass();

            $result->description = "Test";
            $result->packages = $packages;

            return responseSuccessWithPaginateMulti(trans('admin.Packages'), $result, $packages);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $package = new PackageResource(Package::with('plans.meals.image')->where('id',$id)->first());
            return responseSuccess($package->name, $package);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }
}
