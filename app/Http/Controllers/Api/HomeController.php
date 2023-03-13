<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Slider\SlidersResource;
use App\Http\Resources\Subscription\SubscriptionDetailsResource;
use App\Http\Resources\Wallet\WalletResource;
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
            $slider = collect([
                (object)[
                    'id' => 1,
                    'url' => url('storage/sliders/01.jpg'),
                    'link' => url("")
                ],
                (object)[
                    'id' => 2,
                    'url' => url('storage/sliders/02.jpg'),
                    'link' => url("")
                ],
                (object)[
                    'id' => 3,
                    'url' => url('storage/sliders/03.jpg'),
                    'link' => url("")
                ],
            ]);

            $wallet = (object)[
                "total"=>number_format(10.123 ,3),
            ];

            $subscription_details = Subscription::where('user_id',userLogin()->id)->first();
            
            
            $total_calories = collect([
                (object)[
                    'id' => 1,
                    'image' => "",
                    'total' => 300,
                    'day' => "Sat",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 2,
                    'image' => "",
                    'total' => 400,
                    'day' => "Mon",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 3,
                    'image' => "",
                    'total' => 500,
                    'day' => "Fri",
                    'date' => "06.03.2023",
                ],
                
            ]);

            $calories_burned = collect([
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Sat",
                    'date' => "06.03.2023",
                    'burned' => true,
                ],
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Mon",
                    'date' => "06.03.2023",
                    'burned' => true,
                ],
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Fri",
                    'date' => "06.03.2023",
                    'burned' => false,
                ],
            ]);

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
            $slider = collect([
                (object)[
                    'id' => 1,
                    'url' => url('storage/sliders/01.jpg'),
                    'link' => url("")
                ],
                (object)[
                    'id' => 2,
                    'url' => url('storage/sliders/02.jpg'),
                    'link' => url("")
                ],
                (object)[
                    'id' => 3,
                    'url' => url('storage/sliders/03.jpg'),
                    'link' => url("")
                ],
            ]);

            $wallet = (object)[
                "total"=>number_format(10.123 ,3),
            ];

            $subscription_details = (object)[
                "id"=>1,
                "dey_left"=>70,
                'end_date'=>Carbon::now()->addDays(70)->format('Y-m-d')
            ];

            $total_calories = collect([
                (object)[
                    'id' => 1,
                    'image' => "",
                    'total' => 300,
                    'day' => "Sat",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 2,
                    'image' => "",
                    'total' => 400,
                    'day' => "Mon",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 3,
                    'image' => "",
                    'total' => 500,
                    'day' => "Fri",
                    'date' => "06.03.2023",
                ],
                
            ]);

            $calories_burned = collect([
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Sat",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Mon",
                    'date' => "06.03.2023",
                ],
                (object)[
                    'id' => 3,
                    'total' => 500,
                    'day' => "Fri",
                    'date' => "06.03.2023",
                ],
            ]);
            
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
