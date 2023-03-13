<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Calory;
use Illuminate\Http\Request;

class CaloriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.calories.index', [
            'title' => trans('admin.calories'),
            'calories' => Calory::paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Calory  $calory
     * @return \Illuminate\Http\Response
     */
    public function show(Calory $calory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calory  $calory
     * @return \Illuminate\Http\Response
     */
    public function edit(Calory $calory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calory  $calory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calory $calory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calory  $calory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calory $calory)
    {
        //
    }
}
