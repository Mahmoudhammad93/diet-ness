<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\ProfileResource;
use App\Models\FcmToken;
use App\Models\User;
use App\Models\UserDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile'            => 'required',
                'password'          => 'required|min:6',
            ], [], [
                'mobile'            => trans('admin.Mobile'),
                'password'          => trans('admin.Password'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $credentials = $request->only('mobile', 'password');
            if (Auth::attempt($credentials)) {

                $token = FcmToken::where('user_id', Auth::user()->id)->first();
                if (!$token) {
                    FcmToken::create([
                        'user_id' => Auth::user()->id,
                        'token' => $request->fcm_token,
                        'device_type' => $request->device_type
                    ]);
                } else {
                    if ($token->token != $request->fcm_token) {
                        FcmToken::where('user_id', Auth::user()->id)->update([
                            'token' => $request->fcm_token,
                            'device_type' => $request->device_type
                        ]);
                    }
                }

                $user = User::where('id', Auth::user()->id)->with('fcm_token', 'details')->first();
                $token = $request->user()->createToken($request->device_type);
                $result = new \stdClass();
                $result->token = $token->plainTextToken;
                $result->user = new ProfileResource($user);
                return responseSuccess(trans('admin.Login Success'), $result);
            } else {
                return responseValid(trans('admin.Invalid Data'));
            }
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name'          => 'required',
                'last_name'          => 'required',
                'mobile'        => 'nullable|unique:users',
                'email'         => 'nullable|unique:users',
                'password'      => 'required|min:6',
                'device_type'   => 'required',
                'fcm_token'     => 'required',
            ], [], [
                'first_name'          => trans('admin.First Name'),
                'last_name'          => trans('admin.Last Name'),
                'mobile'        => trans('admin.Mobile'),
                'email'         => trans('admin.Email'),
                'password'      => trans('admin.Password'),
                'device_type'   => trans('admin.Device Type'),
                'fcm_token'     => trans('admin.Fcm Token'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $user = new User();
            $user->user_type = "user";
            $user->name = $request->first_name ." ". $request->last_name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->password = bcrypt($request->password);
            $user->save();

            FcmToken::create([
                'user_id' => $user->id,
                'token' => $request->fcm_token,
                'device_type' => $request->device_type
            ]);

            UserDetail::create([
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
            ]);

            $credentials = $request->only('mobile', 'password');
            if (Auth::attempt($credentials)) {
                $user = User::where('id', Auth::user()->id)->with('fcm_token', 'details')->first();
                $token = $request->user()->createToken($request->device_type);
                $result = new \stdClass();
                $result->token = $token->plainTextToken;
                $result->user = new ProfileResource($user);
                return responseSuccess(trans('admin.Register Success'), $result);
            } else {
                return responseSuccessMessage(trans('admin.Register Success Please Login'));
            }
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function logout()
    {
        try {
            request()->user()->currentAccessToken()->delete();
            return responseSuccessMessage(trans('admin.Logout Success'));
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function refresh_token(Request $request)
    {
        try {
            $token = FcmToken::where('user_id', Auth::user()->id)->first();
            if ($token->token != $request->fcm_token) {
                FcmToken::where('user_id', Auth::user()->id)->update([
                    'token' => $request->fcm_token,
                ]);
            }
            return responseSuccessMessage(trans('admin.operation success'));
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }
}
