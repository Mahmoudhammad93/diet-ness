<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Address\AddressesResource;
use App\Http\Resources\Address\AreasResource;
use App\Http\Resources\Address\CitiesResource;
use App\Models\Address;
use App\Models\Area;
use App\Models\City;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $addresses = AddressesResource::collection(Address::with('area.city')->where('user_id', userLogin()->id)->get());
            return responseSuccess(trans('admin.Addresses'), $addresses);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cities()
    {
        try {
            $cities = CitiesResource::collection(City::orderBy('name_' . lang(), 'asc')->get());
            return responseSuccess(trans('admin.Cities'), $cities);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function areas($id)
    {
        try {
            $areas = AreasResource::collection(Area::where('city_id', $id)->orderBy('name_' . lang(), 'asc')->get());
            return responseSuccess(trans('admin.Areas'), $areas);
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
        try {
            $validator = Validator::make($request->all(), [
                'title'         => 'required',
                'area_id'       => 'required',
                'street'        => 'required',
                'apartment_no'  => 'required',
                'floor'         => 'required',
            ], [], [
                'title'         => trans('admin.Title'),
                'area_id'       => trans('admin.Area'),
                'street'        => trans('admin.Street'),
                'apartment_no'  => trans('admin.Apartment No'),
                'floor'         => trans('admin.Floor No'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }

            $address = Address::create([
                'user_id' => userLogin()->id,
                'area_id' => $request->area_id,
                'title' => $request->title,
                'floor' => $request->floor,
                'street' => $request->street,
                'apartment_no' => $request->apartment_no,
                'is_default' => 1,
            ]);

            Address::where('id', '!=', $address->id)->where('user_id', userLogin()->id)->update(['is_default' => 0]);
            $address = new AddressesResource(Address::where('user_id', userLogin()->id)->with('area.city')->first());
            return responseSuccess(trans('admin.Address Added Successful'), $address);
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
    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'         => 'required',
                'area_id'       => 'required',
                'street'        => 'required',
                'apartment_no'  => 'required',
                'floor'         => 'required',
            ], [], [
                'title'         => trans('admin.Title'),
                'area_id'       => trans('admin.Area'),
                'street'        => trans('admin.Street'),
                'apartment_no'  => trans('admin.Apartment No'),
                'floor'         => trans('admin.Floor No'),
            ]);
            if ($validator->fails()) {
                $errorString = implode(",", $validator->errors()->all());
                return responseValid($errorString);
            }


            $address = Address::where('id',$request->address_id)->where('user_id', userLogin()->id)->update([
                'area_id' => $request->area_id,
                'title' => $request->title,
                'floor' => $request->floor,
                'street' => $request->street,
                'apartment_no' => $request->apartment_no,
                'is_default' => $request->is_default,
            ]);
            Address::where('id', '!=', $request->address_id)->where('user_id', userLogin()->id)->update(['is_default' => 0]);

            $address = new AddressesResource(Address::where('user_id', userLogin()->id)->with('area.city')->first());
            return responseSuccess(trans('admin.Updated Success'), $address);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {
            $address = Address::where('user_id', userLogin()->id)->where('id', $request->address_id)->first();
            if ($address) {
                $address->delete();
            }
            $addresses = AddressesResource::collection(Address::with('area.city')->where('user_id', userLogin()->id)->get());
            return responseSuccess(trans('admin.Deleted Success'), $addresses);
        } catch (Exception $ex) {
            return responseError($ex);
        }
    }
}
