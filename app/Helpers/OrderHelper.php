<?php

namespace App\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderDeliveryStatus;

class OrderHelper extends Controller
{
    public static function success($orderId , $paymentStatus){

        Order::where('id', $orderId)->update([
            'status' => $paymentStatus
        ]);

        OrderDeliveryStatus::create([
            'order_id'=>$orderId,
            'status'=>'pending'
        ]);

        $order = Order::where('id', $orderId)->first();

        Cart::where('user_id', $order->user_id)->delete();

        Notification::create([
            'model' => "\App\Models\Order",
            'model_id' => $orderId,
            'title_ar' => "طلب جديد",
            'title_en' => "New Order",
            'content_ar' => "لديك طلب جديد من العضو " .$order->user->name,
            'content_en' => "Have New Order From "  .$order->user->name,
        ]);

    }

}
