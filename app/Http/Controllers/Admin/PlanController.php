<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Component;
use App\Models\Meal;
use App\Models\MealComponents;
use App\Models\Package;
use App\Models\Plan;
use App\Models\PlanMeal;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $package = Package::where('id', $id)->first();
        $plans = Plan::where('package_id', $package->id)->with('meals')->paginate(30);

        return view('admin.plans.index', [
            'title' => $package->name,
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $package = Package::where('id', $id)->first();
        $categories = Category::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();
        $meals = Meal::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();
        $components = Component::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();


        return view('admin.plans.create', [
            'title' => $package->name . " - " . trans('admin.Add New Plan'),
            'package' => $package,
            'categories' => $categories,
            'meals' => $meals,
            'components' => $components
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'details_ar'        => 'required',
            'details_en'        => 'required',
            'duration'          => 'required',
            'new_price'         => 'required',
            'meal_name_ar'      => 'array|min:1',
            'meal_name_en'      => 'array|min:1',
            'meal_details_ar'   => 'array|min:1',
            'meal_details_en'   => 'array|min:1',
            'meal_price'        => 'array|min:1',
            'quantity'          => 'array|min:1',
            'max'               => 'array|min:1',
            'min'               => 'array|min:1',
            'meal_name_ar.*'    => 'required',
            'meal_name_en.*'    => 'required',
            'meal_details_ar.*' => 'required',
            'meal_details_en.*' => 'required',
            'meal_price.*'      => 'required',
            'quantity.*'        => 'required',
            'max.*'             => 'required',
            'min.*'             => 'required',
        ], [], [
            'name_ar'        => trans('admin.Name Ar'),
            'name_en'        => trans('admin.Name En'),
            'details_ar'        => trans('admin.Details Ar'),
            'details_en'        => trans('admin.Details En'),
            'duration'        => trans('admin.Duration'),
            'new_price'        => trans('admin.New Price'),
            'meal_name_ar'        => trans('admin.Meal Name Ar'),
            'meal_name_en'        => trans('admin.Meal Name En'),
            'meal_details_ar'        => trans('admin.Meal Details Ar'),
            'meal_details_en'        => trans('admin.Meal Details En'),
            'meal_price'        => trans('admin.Meal Price'),
            'quantity'        => trans('admin.Quantity'),
            'max'        => trans('admin.Max'),
            'min'        => trans('admin.Min'),
        ]);

        $plan = new Plan();
        $plan->package_id = $request->package_id;
        $plan->name_ar = $request->name_ar;
        $plan->name_en = $request->name_en;
        $plan->details_ar = $request->details_ar;
        $plan->details_en = $request->details_en;
        $plan->duration = $request->duration;
        $plan->new_price = $request->new_price;
        $plan->is_default = ($request->is_default == "on") ? 1 : 0;
        $plan->save();

        if ($request->is_default == "on") {
            Plan::where('package_id', $request->package_id)->where('id', '!=', $plan->id)->update([
                'is_default' => 0
            ]);
        }

        if ($request->meal_details_ar) {
            foreach ($request->meal_details_ar as $index => $meal_ar) {
                if ($request->meal_details_ar[$index] != "") {
                    $meal = new PlanMeal();
                    if($request->hasFile('image')){
                        // return $request;
                        $file = $request->image[$index];
                        $originFileName = $file->getClientOriginalName();
                        $fileName = time().'.'.$file->getClientOriginalExtension();
                        $file->move(public_path('storage/meals'), $fileName);
                        $meal->image = $fileName;
                    }
                    $meal->plan_id = $plan->id;
                    $meal->name_ar = $request->meal_name_ar[$index];
                    $meal->name_en = $request->meal_name_en[$index];
                    $meal->price = $request->meal_price[$index];
                    $meal->details_ar = $request->meal_details_ar[$index];
                    $meal->details_en = $request->meal_details_en[$index];
                    $meal->quantity = $request->quantity[$index];
                    $meal->max = $request->max[$index];
                    $meal->min = $request->min[$index];
                    $meal->meal_id = $request->meal[$index];
                    $meal->category_id = $request->category[$index];
                    $meal->save();

                    foreach($request->components as $component){
                        MealComponents::create([
                            'component_id' => $component,
                            'plan_meal_id' => $meal->id
                        ]);
                    }
                }
            }
        }

        userLogs([
            'model' => '\App\Models\Plan',
            'model_id' => $plan->id,
            'description_ar' => 'اضافة خطة جديد',
            'description_en' => 'Add New Plan',
            'status' => 'create'
        ]);

        return redirect(aurl('packages/view/' . $request->package_id))->with("success" . "Created Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plan = Plan::where('id', $id)->with('package', 'meals')->first();
        return view('admin.plans.view', [
            'title' => $plan->package->name . " - " . $plan->name,
            'plan' => $plan
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

        $plan = Plan::where('id', $id)->with('package', 'meals')->first();
        // return $plan;
        foreach($plan->meals as $meal){
            $meal->components = MealComponents::select('id', 'component_id')->where('plan_meal_id', $meal->id)->pluck('component_id');
        }
        // return $plan;
        $categories = Category::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();
        $meals = Meal::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();
        $components = Component::select([
            'id',
            app()->getLocale().'_name as name'
        ])->get();
        
        return view('admin.plans.edit', [
            'title' => $plan->package->name . " - " . $plan->name,
            'plan' => $plan,
            'categories' => $categories,
            'meals' => $meals,
            'components' => $components
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
        // return $request;
        $request->validate([
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'details_ar'        => 'required',
            'details_en'        => 'required',
            'duration'          => 'required',
            'new_price'         => 'required',
            'meal_name_ar'      => 'array|min:1',
            'meal_name_en'      => 'array|min:1',
            'meal_details_ar'   => 'array|min:1',
            'meal_details_en'   => 'array|min:1',
            'meal_price'        => 'array|min:1',
            'quantity'          => 'array|min:1',
            'max'               => 'array|min:1',
            'min'               => 'array|min:1',
            'meal_name_ar.*'    => 'required',
            'meal_name_en.*'    => 'required',
            'meal_details_ar.*' => 'required',
            'meal_details_en.*' => 'required',
            'meal_price.*'      => 'required',
            'quantity.*'        => 'required',
            'max.*'             => 'required',
            'min.*'             => 'required',
        ], [], [
            'name_ar'        => trans('admin.Name Ar'),
            'name_en'        => trans('admin.Name En'),
            'details_ar'        => trans('admin.Details Ar'),
            'details_en'        => trans('admin.Details En'),
            'duration'        => trans('admin.Duration'),
            'new_price'        => trans('admin.New Price'),
            'meal_name_ar'        => trans('admin.Meal Name Ar'),
            'meal_name_en'        => trans('admin.Meal Name En'),
            'meal_details_ar'        => trans('admin.Meal Details Ar'),
            'meal_details_en'        => trans('admin.Meal Details En'),
            'meal_price'        => trans('admin.Meal Price'),
            'quantity'        => trans('admin.Quantity'),
            'max'        => trans('admin.Max'),
            'min'        => trans('admin.Min'),
        ]);

        $plan = Plan::find($id);
        $plan->name_ar = $request->name_ar;
        $plan->name_en = $request->name_en;
        $plan->details_ar = $request->details_ar;
        $plan->details_en = $request->details_en;
        $plan->duration = $request->duration;
        $plan->new_price = $request->new_price;
        $plan->is_default = ($request->is_default == "on") ? 1 : 0;
        $plan->save();

        if ($request->is_default == "on") {
            Plan::where('package_id', $plan->package_id)->where('id', '!=', $plan->id)->update([
                'is_default' => 0
            ]);
        }

        PlanMeal::where('plan_id', $plan->id)->delete();

        if ($request->meal_details_ar) {
            foreach ($request->meal_details_ar as $index => $meal_ar) {
                if ($request->meal_details_ar[$index] != "") {
                    $meal = new PlanMeal();
                    if($request->hasFile('image')){
                        // return $request;
                        if(isset($request->image[$index])){
                            // return $request->image[$index];
                            $file = $request->image[$index];
                            $originFileName = $file->getClientOriginalName();
                            $fileName = time().'.'.$file->getClientOriginalExtension();
                            $file->move(public_path('storage/meals'), $fileName);
                            $meal->image = $fileName;
                        }
                    }
                    $meal->plan_id = $plan->id;
                    $meal->name_ar = $request->meal_name_ar[$index];
                    $meal->name_en = $request->meal_name_en[$index];
                    $meal->price = $request->meal_price[$index];
                    $meal->details_ar = $request->meal_details_ar[$index];
                    $meal->details_en = $request->meal_details_en[$index];
                    $meal->quantity = $request->quantity[$index];
                    $meal->max = $request->max[$index];
                    $meal->min = $request->min[$index];
                    $meal->meal_id = $request->meal[$index];
                    $meal->category_id = $request->category[$index];
                    $meal->save();

                    foreach($request->components as $component){
                        MealComponents::create([
                            'component_id' => $component,
                            'plan_meal_id' => $meal->id
                        ]);
                    }
                }
            }
        }

        userLogs([
            'model' => '\App\Models\Plan',
            'model_id' => $plan->id,
            'description_ar' => 'تحديث بيانات الخطة',
            'description_en' => 'Update Plan Details',
            'status' => 'update'
        ]);

        return redirect(aurl('packages/view/' . $plan->id))->with("success" . "Updated Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $plan = Plan::with('meals')->where('id', $request->plan_id)->first();
        if ($plan) {

            userLogs([
                'model' => '\App\Models\Plan',
                'model_id' => $plan->id,
                'description_ar' => 'حذف الخطة',
                'description_en' => 'Delete Plan',
                'status' => 'delete'
            ]);

            $plan->meals()->delete();
            $plan->delete();
        }
        return back()->with('success', 'Deleted Success');
    }
}
