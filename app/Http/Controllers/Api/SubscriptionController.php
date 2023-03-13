<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Library\Payment;
use App\Models\Address;
use App\Models\Plan;
use App\Models\PlanMeal;
use App\Models\Subscription;
use App\Models\SubscriptionAddress;
use App\Models\SubscriptionMeal;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'plan_id'           => 'required',
                'start_at'          => 'required',
                'meal_id'           => 'required|array|min:1',
                'meal_quantity'     => 'required|array|min:1',
                'meal_price_total'  => 'required|array|min:1',
                'meal_id.*'         => 'required',
                'meal_quantity.*'   => 'required',
                'meal_price_total.*' => 'required',
            ], [], [
                'plan_id'           => trans('admin.Plan Id'),
                'start_at'          => trans('admin.Start At'),
                'meal_id'           => trans('admin.Meal Id'),
                'meal_quantity'     => trans('admin.Meal Quantity'),
                'meal_price_total'  => trans('admin.Meal Price Total'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $plan = Plan::find($request->plan_id);
            if (!$plan) {
                return responseValid(trans('admin.Plan Not Found'));
            }

            $address = Address::where('user_id', userLogin()->id)->where('is_default', 1)->first();
            if (!$address) {
                return responseValid(trans('admin.Address Not Found'));
            }

            $endat = Carbon::parse($request->start_at)->addDays($plan->duration);

            $subscription = new Subscription();
            $subscription->user_id = userLogin()->id;
            $subscription->plan_id = $request->plan_id;
            $subscription->start_at = Carbon::parse($request->start_at);
            $subscription->end_at = Carbon::parse($endat);
            $subscription->total = $request->total;
            $subscription->type = "new";
            $subscription->save();

            SubscriptionAddress::create([
                'subscription_id' => $subscription->id,
                'area_id' => $address->area_id,
                'street' => $address->street,
                'floor' => $address->floor,
                'apartment_no' => $address->apartment_no,
            ]);

            foreach ($request->meal_id as $index => $meal) {
                $planMeal = PlanMeal::find($meal);
                SubscriptionMeal::create([
                    'subscription_id' => $subscription->id,
                    'plan_meal_id' => $meal,
                    'price' => $planMeal->price,
                    'quantity' => $request->meal_quantity[$index],
                    'total' => $request->meal_price_total[$index],
                ]);
            }

            $data = [
                'name' => userLogin()->name,
                'phone' => userLogin()->mobile,
                'email' => userLogin()->email,
            ];

            return Payment::proceed($subscription->id, $request->total, $data);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function renew(Request $request){
        try{
            
            $validator = Validator::make($request->all(), [
                'subscription_id'           => 'required',
            ], [], [
                'subscription_id'           => trans('admin.Subscription'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }



        }catch(Exception $ex){
            return responseError($ex);
        }
    }

    public function change(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'plan_id'           => 'required',
                'start_at'          => 'required',
                'meal_id'           => 'required|array|min:1',
                'meal_quantity'     => 'required|array|min:1',
                'meal_price_total'  => 'required|array|min:1',
                'meal_id.*'         => 'required',
                'meal_quantity.*'   => 'required',
                'meal_price_total.*' => 'required',
            ], [], [
                'plan_id'           => trans('admin.Plan Id'),
                'start_at'          => trans('admin.Start At'),
                'meal_id'           => trans('admin.Meal Id'),
                'meal_quantity'     => trans('admin.Meal Quantity'),
                'meal_price_total'  => trans('admin.Meal Price Total'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $plan = Plan::find($request->plan_id);
            if (!$plan) {
                return responseValid(trans('admin.Plan Not Found'));
            }

            $address = Address::where('user_id', userLogin()->id)->where('is_default', 1)->first();
            if (!$address) {
                return responseValid(trans('admin.Address Not Found'));
            }

            $endat = Carbon::parse($request->start_at)->addDays($plan->duration);

            $subscription = new Subscription();
            $subscription->user_id = userLogin()->id;
            $subscription->plan_id = $request->plan_id;
            $subscription->start_at = Carbon::parse($request->start_at);
            $subscription->end_at = Carbon::parse($endat);
            $subscription->total = $request->total;
            $subscription->type = "changed";
            $subscription->save();

            SubscriptionAddress::create([
                'subscription_id' => $subscription->id,
                'area_id' => $address->area_id,
                'street' => $address->street,
                'floor' => $address->floor,
                'apartment_no' => $address->apartment_no,
            ]);

            foreach ($request->meal_id as $index => $meal) {
                $planMeal = PlanMeal::find($meal);
                SubscriptionMeal::create([
                    'subscription_id' => $subscription->id,
                    'plan_meal_id' => $meal,
                    'price' => $planMeal->price,
                    'quantity' => $request->meal_quantity[$index],
                    'total' => $request->meal_price_total[$index],
                ]);
            }

            $data = [
                'name' => userLogin()->name,
                'phone' => userLogin()->mobile,
                'email' => userLogin()->email,
            ];

            return Payment::proceed($subscription->id, $request->total, $data);
        }catch(Exception $ex){
            return responseError($ex);
        }
    }

}
