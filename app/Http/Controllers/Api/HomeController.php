<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\Slider\SlidersResource;
use App\Http\Resources\Subscription\SubscriptionDetailsResource;
use App\Http\Resources\Wallet\WalletResource;
use App\Models\Calory;
use App\Models\Category;
use App\Models\Component;
use App\Models\MealComponents;
use App\Models\Package;
use App\Models\Plan;
use App\Models\PlanMeal;
use App\Models\Slider;
use App\Models\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $slider = Slider::whereStatus(1)->select([
                'id', 'image', 'link'
            ])->get();

            $wallet = (object)[
                "total"=>number_format(10.123 ,3),
            ];

            $subscription_details = Subscription::where('user_id',userLogin()->id)->first();
            
            
            $total_calories = Calory::select([
                'id', 'image', 'total', 'day', 'date', 'burned'
            ])->get();

            $calories_burned = Calory::whereBurned(1)->select([
                'id', 'image', 'total', 'day', 'date', 'burned'
            ])->get();

            $result = new \stdClass();
            $result->sliders = SlidersResource::collection($slider);
            $result->wallet = new WalletResource($wallet);
            $result->subscription_details = new SubscriptionDetailsResource($subscription_details);
            $result->total_calories = $total_calories;
            $result->calories_burned = $calories_burned;
            return responseSuccess(trans('admin.Home'), $result);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guest()
    {
        try {
            $slider = Slider::whereStatus(1)->select([
                'id', 'image', 'link'
            ])->get();

            $wallet = (object)[
                "total"=>number_format(10.123 ,3),
            ];

            $subscription_details = (object)[
                "id"=>1,
                "dey_left"=>70,
                'end_date'=>Carbon::now()->addDays(70)->format('Y-m-d')
            ];

            $total_calories = Calory::select([
                'id', 'image', 'total', 'day', 'date', 'burned'
            ])->get();

            $calories_burned = Calory::whereBurned(1)->select([
                'id', 'image', 'total', 'day', 'date', 'burned'
            ])->get();
            
            $result = new \stdClass();
            $result->sliders = SlidersResource::collection($slider);
            $result->wallet = new WalletResource($wallet);
            $result->subscription_details = $subscription_details;
            $result->total_calories = $total_calories;
            $result->calories_burned = $calories_burned;
            return responseSuccess(trans('admin.Home'), $result);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function getMenu(Request $request){
        try {
            $user = userLogin();
            $subscription = Subscription::where('user_id', $user->id)->first();
            $categories = Category::select([
                'id',
                $request->header('Accept-Language').'_name as name'
            ])->get();
            $plan = Plan::whereId($subscription->plan_id)->first();
            $plan_meals = PlanMeal::select([
                'id',
                'plan_id',
                'details_'.$request->header('Accept-Language').' as details',
                'meal_id',
                'category_id'
            ])->where('plan_id',$plan->id)->get();
            
            $data = Package::whereId($plan->package_id)->first();

            return $plan_meals;

            foreach($categories as $cate){
                foreach($plan_meals as $meal){
                    $components = MealComponents::select('id', 'component_id')->where('plan_meal_id', $meal->id)->get();
                    foreach($components as $c){
                        $meal->components = Component::select([
                            'id',
                            $request->header('Accept-Language').'_name as name'
                        ])->whereId($c->component_id)->get();
                    }

                    if($meal->category_id == $cate->id){
                        $cate_meals[] = $meal;
                    }

                    return $cate_meals;

                    $plan[$cate->name] = $cate_meals;
                }
            }

            // return $plan_meals;


            $data->plan = $plan;


            return responseSuccess($data->name, $data);
        } catch (Exception $ex) {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
