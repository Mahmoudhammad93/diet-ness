<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscription::with('plan', 'user')->where('payment_status', 'paid')->latest()->paginate(20);

        return view('admin.subscriptions.index', [
            'title' => trans('admin.All Subscriptions'),
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function started()
    {
        $subscriptions = Subscription::with('plan', 'user')->where('status','started')->where('payment_status', 'paid')->latest()->paginate(20);

        return view('admin.subscriptions.index', [
            'title' => trans('admin.All Subscriptions'),
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ended()
    {
        $subscriptions = Subscription::with('plan', 'user')->where('status','ended')->where('payment_status', 'paid')->latest()->paginate(20);

        return view('admin.subscriptions.index', [
            'title' => trans('admin.All Subscriptions'),
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = Subscription::with('plan', 'user', 'meals', 'address')->where('id', $id)->first();
        return view('admin.subscriptions.view', [
            'title' => $subscription->plan->name,
            'subscription' => $subscription
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
