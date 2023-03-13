<?php

use App\Models\AdminLog;
use App\Models\ErrorLog;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;

function responseSuccess($message, $data)
{
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
    ], 200);
}

function responseSuccessWithPaginate($message, $data)
{
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
        "paginate" => [
            'current_page' => $data->currentPage(),
            'has_pages' => $data->hasPages(),
            'last_page' => $data->lastPage(),
            'next_page_url' => (string)$data->nextPageUrl(),
            'per_page' => $data->perPage(),
        ]
    ], 200);
}

function responseSuccessWithPaginateMulti($message, $data, $model)
{
    return response([
        "success" => true,
        "message" => $message,
        "data"    => $data,
        "paginate" => [
            'current_page' => $model->currentPage(),
            'has_pages' => $model->hasPages(),
            'last_page' => $model->lastPage(),
            'next_page_url' => (string)$model->nextPageUrl(),
            'per_page' => $model->perPage(),
        ]
    ], 200);
}

function responseSuccessMessage($message)
{
    return response([
        "success" => true,
        "message" => $message,
    ], 200);
}

function responseError($exception)
{
    $userId = 0;
    if (Auth::check()) {
        if (userLogin()) {
            $userId = userLogin()->id;
        }
    }
    ErrorLog::create([
        'user_id' => $userId,
        'code' => $exception->getCode(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'message' => $exception->getMessage(),
        'trace' => $exception->getTraceAsString(),
    ]);
    return response([
        "success" => false,
        "message" => trans('app.sorry_somthing_wrong'),
        "file" => $exception->getFile(),
        "line" => $exception->getLine(),
        "exception" => $exception->getMessage(),
    ], 200);
}

function responseValid($message)
{
    return response([
        "success" => false,
        "message" => $message
    ], 200);
}

if (!function_exists('userLogin')) {
    function userLogin()
    {
        return Auth::user();
    }
}

if (!function_exists('currentCurrency')) {
    function currentCurrency()
    {
        return trans('admin.KWD');
    }
}

if (!function_exists('userLogs')) {
    function userLogs($data)
    {
        $log = new AdminLog();
        $log->user_id = Auth::user()->id;
        $log->model = $data["model"];
        $log->model_id = $data['model_id'];
        $log->description_ar = $data['description_ar'];
        $log->description_en = $data['description_en'];
        $log->status = $data['status'];
        $log->save();

        Notification::create([
            'user_id' => Auth::user()->id,
            'model' => $data["model"],
            'model_id' => $data['model_id'],
            'title_ar' => Auth::user()->name,
            'title_en' => Auth::user()->name,
            'content_ar' => $data['description_ar'],
            'content_en' => $data['description_en'],
        ]);
    }
}

if (!function_exists('aurl')) {
    function aurl($url)
    {
        return url('/admin/' . $url);
    }
}

if (!function_exists('curl')) {
    function curl($curl)
    {
        return url('/company/' . $curl);
    }
}

if (!function_exists('surl')) {
    function surl($surl)
    {
        return url('/store/' . $surl);
    }
}

if (!function_exists('lang')) {
    function lang()
    {
        if (Request::is('api/*')) {
            return request()->header('Accept-Language');
        } else {
            if (session()->has('lang')) {
                return session()->get('lang');
            } else {
                if (Auth::check()) {
                    if (adminLogin()->details()->exists()) {
                        session()->put('lang', adminLogin()->details->language);
                        return adminLogin()->details->language;
                    }
                }
                session()->put('lang', 'ar');
                return 'ar';
            }
        }
    }
}

if (!function_exists('theme')) {
    function theme()
    {
        if (session()->has('theme')) {
            return session()->get('theme');
        } else {
            if (Auth::check()) {
                if (adminLogin()->details()->exists()) {
                    session()->put('theme', adminLogin()->details->theme);
                    return adminLogin()->details->theme;
                }
            }
            session()->put('theme', 'dark');
            return 'dark';
        }
    }
}

if (!function_exists('exceptions')) {
    function exceptions()
    {
        return ErrorLog::where('status', 'new')->take(20)->latest()->get();
    }
}

if (!function_exists('notifications')) {
    function notifications()
    {
        return Notification::with('user.profile')->whereHas('user')->where('model', '!=', '\App\Models\Order')->take(20)->latest()->get();
    }
}

if (!function_exists('notificationsCount')) {
    function notificationsCount()
    {
        return Notification::with('user.profile')->whereHas('user')->where('model', '!=', '\App\Models\Order')->where('admin_read_at', null)->take(21)->latest()->get();
    }
}

if (!function_exists('newOrders')) {
    function newOrders()
    {
        return Notification::where('model', '\App\Models\Order')->with('user.profile')->whereHas('user')->orderBy('created_at', 'desc')->limit(20)->get();
    }
}

if (!function_exists('newOrdersCount')) {
    function newOrdersCount()
    {
        return Notification::where('model', '\App\Models\Order')->with('user.profile')->whereHas('user')->where('admin_read_at', null)->orderBy('created_at', 'desc')->limit(21)->get();
    }
}

if (!function_exists('companyNewOrders')) {
    function companyNewOrders()
    {
        return Notification::where('model', '\App\Models\Order')->with('user.profile')->whereHas('user')->where('user_id', adminLogin()->id)->orderBy('created_at', 'desc')->limit(20)->get();
    }
}

if (!function_exists('companyNewOrdersCount')) {
    function companyNewOrdersCount()
    {
        return Notification::where('model', '\App\Models\Order')->with('user.profile')->whereHas('user')->where('user_id', adminLogin()->id)->where('read_at', null)->orderBy('created_at', 'desc')->limit(21)->get();
    }
}

if (!function_exists('settings')) {
    function settings()
    {
        return Setting::latest()->first();
    }
}

if (!function_exists('adminLogin')) {
    function adminLogin()
    {
        return User::where('id', Auth::user()->id)->with( 'details')->first();
    }
}

function responseForm($message, $url)
{
    Session::flash('success', 'operation success');
    return response()->json([
        "success" => true,
        "message" => $message,
        "url" => $url,
    ]);
}

function responseFormError($message)
{
    return response()->json([
        "success" => false,
        "message" => $message,
    ]);
}

if (!function_exists('generateSlug')) {
    function generateSlug($slug, $id = null)
    {
        $data = User::where('slug', $slug)->exists();
        if ($data) {
            return $slug . "." . uniqid();
        } else {
            return $slug;
        }
    }
}

if (!function_exists('dayName')) {
    function dayName($name)
    {
        if ($name == "Friday") {
            return "fri";
        } elseif ($name == "Saturday") {
            return "sat";
        } elseif ($name == "Sunday") {
            return "sun";
        } elseif ($name == "Monday") {
            return "mon";
        } elseif ($name == "Tuesday") {
            return "tue";
        } elseif ($name == "Wednesday") {
            return "wed";
        } elseif ($name == "Thursday") {
            return "thu";
        }
    }
}

function fcm_notification($notifyData, $details, $token)
{

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60 * 20);

    $notificationBuilder = new PayloadNotificationBuilder($details['title']);
    $notificationBuilder->setBody($details['body'])
        ->setSound('default');

    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData($notifyData);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $token = [$token];

    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();

    // return Array - you must remove all this tokens in your database
    $downstreamResponse->tokensToDelete();

    // return Array (key : oldToken, value : new token - you must change the token in your database)
    $downstreamResponse->tokensToModify();

    // return Array - you should try to resend the message to the tokens in the array
    $downstreamResponse->tokensToRetry();

    // return Array (key:token, value:error) - in production you should remove from your database the tokens
    $downstreamResponse->tokensWithError();
}
