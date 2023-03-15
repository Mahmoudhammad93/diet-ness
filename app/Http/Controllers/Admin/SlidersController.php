<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v3;

class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.sliders.index', [
            'title' => trans('admin.Sliders'),
            'sliders' => Slider::paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create', [
            'title' => trans('admin.Create Slider')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required',
            'link' => 'required',
            'status' => 'required'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $originFileName = $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/sliders'), $fileName);
            $request['image'] = $fileName;
        }

        Slider::create([
            'image' => $fileName,
            'link' => $request->link,
            'status' => $request->status
        ]);

        return redirect('admin/sliders');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', [
            'title'=> trans('admin.Edit Slider'),
            'slider' => $slider
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'link' => 'required',
            'status' => 'required'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $originFileName = $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/sliders'), $fileName);
            $request['image'] = $fileName;
            $slider->image = $fileName;
        }

        $slider->link = $request->link;
        $slider->status = $request->status;

        $slider->save();

        return redirect('admin/sliders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect('admin/sliders');
    }
}
