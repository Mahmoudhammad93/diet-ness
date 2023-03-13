<?php

namespace App\Library;

use App\Http\Controllers\Controller;
use App\Http\Resources\Subscription\SubscriptionResource;
use App\Models\Notification;
use App\Models\OrderTransaction;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Payment extends Controller
{
    //// Test /////
    private static $apiURL = "https://apitest.myfatoorah.com/";
    private static $apiToken = "rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL";

    public static function proceed($orderId, $total, $dataUser)
    {
        try {
            $data = [
                'PaymentMethodId' => 1,
                'CustomerName' => $dataUser["name"],
                'DisplayCurrencyIso' => "KWD",
                'CurrencyIso' => "KWD",
                'MobileCountryCode' => "+965",
                'CustomerMobile' => $dataUser["phone"],
                'CustomerEmail' => $dataUser["email"],
                'InvoiceValue' => number_format($total, 3),
                'InvoiceAmount' => number_format($total, 3),
                'CallBackUrl' => url('api/payment/callback/success'),
                'ErrorUrl' => url('api/payment/callback/faild'),
                'Language' => lang(),
                'CustomerReference' => $orderId,
                'CustomerCivilId' => 12345678,
                'UserDefinedField' => userLogin()->id,
                'ExpireDate' => '',
            ];

            $response = Http::withToken(self::$apiToken)->post(self::$apiURL . "/v2/ExecutePayment", $data);
            if($response->successful()){
                $paymentURL = $response->json('Data')["PaymentURL"];
                return responseSuccess(trans('admin.PAYMENT'), $paymentURL);
            }else{
                return $response;
            }
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function callback_success(Request $request)
    {
        try {
            $response = Http::withToken(self::$apiToken)->post(self::$apiURL . "/v2/getPaymentStatus", [
                'Key' => $request->paymentId,
                'KeyType' => 'paymentId',
            ]);

            $orderId = $response->json('Data')["CustomerReference"];

            OrderTransaction::create([
                'subscription_id' => $orderId,
                'transaction' => json_encode($request->all()),
                'response' => $response
            ]);

            if ($response['IsSuccess'] && $response->json('Data')["InvoiceStatus"] == "Paid") {

                Subscription::where('id', $orderId)->update([
                    'payment_status' => 'paid'
                ]);

                $subscription = Subscription::where('id', $orderId)->with('user', 'meals.meal', 'plan')->first();

                Notification::create([
                    'model' => "\App\Models\Subscription",
                    'model_id' => $orderId,
                    'title_ar' => "اشتراك جديد",
                    'title_en' => "New Subscription",
                    'content_ar' => "لديك اشتراك جديد من العضو " . $subscription->user->name,
                    'content_en' => "Have New Subscription From "  . $subscription->user->name,
                ]);

                $data = new SubscriptionResource($subscription);
                return responseSuccess(trans('admin.Payment completed successfully'), $data);
            }

            Subscription::where('id', $orderId)->update([
                'payment_status' => 'unpaid'
            ]);

            return responseValid(trans('admin.Payment Faild'));
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function callback_faild(Request $request)
    {
        try {
            $response = Http::withToken(self::$apiToken)->post(self::$apiURL . "/v2/getPaymentStatus", [
                'Key' => $request->paymentId,
                'KeyType' => 'paymentId',
            ]);
            $orderId = $response->json('Data')["CustomerReference"];
            OrderTransaction::create([
                'subscription_id' => $orderId,
                'transaction' => json_encode($request->all())
            ]);
            return responseValid(trans('admin.Payment Faild'));
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }
}
