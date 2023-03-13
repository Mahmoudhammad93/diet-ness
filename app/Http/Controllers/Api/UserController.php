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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        try {
            $user = new ProfileResource(User::where('id', userLogin()->id)->first());
            return responseSuccess(trans('admin.Profile'), $user);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name'          => 'nullable',
                'mobile'        => 'nullable|unique:users,mobile,' . userLogin()->id,
                'email'         => 'nullable|unique:users,email,' . userLogin()->id,
            ], [], [
                'name'          => trans('admin.Name'),
                'mobile'        => trans('admin.Mobile'),
                'email'         => trans('admin.Email'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $user = User::where('id', userLogin()->id)->first();

            if ($request->new_password) {
                if (Hash::check($request->old_password, $user->password)) {
                    $user->password = Hash::make($request->new_password);
                } else {
                    return responseValid(trans('admin.Old Password Is Wrong Please Try Again'));
                }
            }

            if ($request->first_name) {
                UserDetail::where('user_id', $user->id)->update([
                    'first_name' => $request->first_name
                ]);
            }

            if ($request->last_name) {
                UserDetail::where('user_id', $user->id)->update([
                    'last_name' => $request->last_name
                ]);
            }

            if ($request->gender) {
                UserDetail::where('user_id', $user->id)->update([
                    'gender' => $request->gender
                ]);
            }

            if ($request->birth_date) {
                UserDetail::where('user_id', $user->id)->update([
                    'birth_date' => $request->birth_date
                ]);
            }

            if ($request->mobile) {
                $user->mobile = $request->mobile;
            }

            if ($request->email) {
                $user->email = $request->email;
            }

            $user->save();

            $user = new ProfileResource(User::where('id', userLogin()->id)->first());
            $result = new \stdClass();
            $result->user = new ProfileResource($user);

            return responseSuccess(trans('admin.Updated Success'), $result);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    public function forget_password(Request $request)
    {
        try {
            try {
                $validator = Validator::make($request->all(), [
                    'mobile'            => 'required',
                ], [], [
                    'mobile'            => trans('admin.Mobile'),
                ]);
                if ($validator->fails()) {
                    $errorString = implode(",", $validator->errors()->all());
                    return responseValid($errorString);
                }
                $user = User::where('mobile', $request->mobile)->first();
                if ($user) {
                    $randomCode = mt_rand(100000, 999999);
                    return responseSuccess(trans('admin.OTP Code'), $randomCode);
                } else {
                    return responseValid(trans('admin.Mobile Number Not Found'));
                }
            } catch (\Exception $ex) {
                return responseError($ex);
            }
        } catch (\Exception $ex) {
            return responseError($ex);
        }
    }

    public function forget_password_new(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'mobile'            => 'required',
                'password'          => 'required|min:6',
                'device_type'       => 'required',
                'fcm_token'         => 'required',
            ], [], [
                'mobile'            => trans('admin.Mobile'),
                'password'          => trans('admin.Password'),
                'device_type'       => trans('admin.Device Type'),
                'fcm_token'         => trans('admin.Token'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $user = User::where('mobile', $request->mobile)->first();
            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();

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
                }

                $user = User::where('id', Auth::user()->id)->with('fcm_token', 'details')->first();
                $token = $request->user()->createToken($request->device_type);
                $result = new \stdClass();
                $result->token = $token->plainTextToken;
                $result->user = new ProfileResource($user);
                return responseSuccess(trans('admin.Password Change Successful'), $result);
            } else {
                return responseValid(trans('admin.Mobile Number Not Found'));
            }
        } catch (\Exception $ex) {
            return responseError($ex);
        }
    }

    public function update_password(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password'          => 'required',
                'new_password'          => 'required',
            ], [], [
                'old_password'          => trans('admin.Old Password'),
                'new_password'          => trans('admin.New Password'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $user = User::where('id', userLogin()->id)->first();
            if (Hash::check($request->old_password,$user->password)) {
                $user->password = bcrypt($request->new_password);
                $user->save();
                return responseSuccessMessage(trans('admin.Password Updated Success'));
            }
            return responseValid(trans('admin.Old Password Is Wrong'));
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }
}
