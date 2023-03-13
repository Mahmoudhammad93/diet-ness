<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Plan;
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
        return view('admin.packages.index', [
            'title' => trans('admin.All Packages'),
            'packages' => Package::withCount('plans')->latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.packages.create', [
            'title' => trans('admin.Add New Package'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'description_ar'        => 'required',
            'description_en'        => 'required',
        ], [], [
            'name_ar'        => trans('admin.Name Ar'),
            'name_en'        => trans('admin.Name En'),
            'description_ar'        => trans('admin.Description Ar'),
            'description_en'        => trans('admin.Description En'),
        ]);

        $package = new Package();
        $package->name_ar = $request->name_ar;
        $package->name_en = $request->name_en;
        $package->description_ar = $request->description_ar;
        $package->description_en = $request->description_en;
        $package->save();

        userLogs([
            'model' => 'App\Models\Package',
            'model_id' => $package->id,
            'description_ar' => 'انشاء باقة جديد',
            'description_en' => 'Create New Package',
            'status' => 'create'
        ]);
        return redirect(aurl('packages'))->with('success', 'Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $package = Package::where('id', $id)->withCount('plans')->first();
        $plans = Plan::withCount('meals')->where('package_id', $package->id)->get();

        return view('admin.packages.view', [
            'title' => $package->name,
            'package' => $package,
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::where('id', $id)->first();
        return view('admin.packages.edit', [
            'title' => $package->name,
            'package' => $package
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_ar'        => 'required',
            'name_en'        => 'required',
            'description_ar'        => 'required',
            'description_en'        => 'required',
        ], [], [
            'name_ar'        => trans('admin.Name Ar'),
            'name_en'        => trans('admin.Name En'),
            'description_ar'        => trans('admin.Description Ar'),
            'description_en'        => trans('admin.Description En'),
        ]);

        $package = Package::where('id', $id)->first();
        $package->name_ar = $request->name_ar;
        $package->name_en = $request->name_en;
        $package->description_ar = $request->description_ar;
        $package->description_en = $request->description_en;
        $package->save();

        userLogs([
            'model' => 'App\Models\Package',
            'model_id' => $package->id,
            'description_ar' => 'تحديث بيانات الباقة',
            'description_en' => 'Update Package Details',
            'status' => 'update'
        ]);
        return redirect(aurl('packages'))->with('success', 'Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $package = Package::where('id', $request->package_id)->with('plans.meals')->first();
        if ($package) {

            userLogs([
                'model' => '\App\Models\Package',
                'model_id' => $package->id,
                'description_ar' => 'حذف الباقة',
                'description_en' => 'Delete Package',
                'status' => 'delete'
            ]);

            $package->plans()->delete();
            $package->delete();
        }
        return back()->with('success', 'Deleted Success');
    }
}
