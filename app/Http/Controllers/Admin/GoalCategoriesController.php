<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GoalCategory;
use Illuminate\Http\Request;

class GoalCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.goals.categories.index', [
            'title' => trans('admin.categories'),
            'categories' => GoalCategory::select([
                'id',
                app()->getLocale().'_name as name',
                'image',
                'status',
                'created_at'
            ])->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.goals.categories.create', [
            'title' => trans('admin.create')
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
            'ar_name' => 'required',
            'en_name' => 'required',
            'status' => 'required'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $originFileName = $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/goal_categories'), $fileName);
            $request['image'] = $fileName;
        }

        GoalCategory::create([
            'image' => $fileName,
            'ar_name' => $request->ar_name,
            'en_name' => $request->en_name,
            'status' => $request->status
        ]);

        return redirect('admin/goals/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoalCategory  $goalCategory
     * @return \Illuminate\Http\Response
     */
    public function show(GoalCategory $goalCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoalCategory  $goalCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(GoalCategory $goalCategory)
    {
        return view('admin.goals.categories.edit', [
            'title' => trans('admin.Edit'),
            'category' => $goalCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoalCategory  $goalCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoalCategory $goalCategory)
    {
        $validated = $request->validate([
            'ar_name' => 'required',
            'en_name' => 'required',
            'status' => 'required'
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $originFileName = $file->getClientOriginalName();
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('storage/goal_categories'), $fileName);
            $request['image'] = $fileName;
            $goalCategory->image = $fileName;
        }

        $goalCategory->ar_name = $request->ar_name;
        $goalCategory->en_name = $request->en_name;
        $goalCategory->status = $request->status;

        $goalCategory->save();

        return redirect('admin/goals/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoalCategory  $goalCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoalCategory $goalCategory)
    {
        //
    }
}
