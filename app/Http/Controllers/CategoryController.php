<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data=Category::all();
        return view('backend_app.categories',compact('data'));
        } catch (\Throwable $th) {
           return back()->with('error','Something Went Wrong');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'slug'=>'required',
        ]);
        try {
            $data=new Category;
            $data->name=$request->name;
            $data->slug=$request->slug;
            $data->description=$request->description;

            if ($request->hasFile('img')) {
                $image=$request->file('img');
                $imgname=$request->file('img')->getClientOriginalName();

                $destinationpath=public_path('assets/category/');
                $image->move($destinationpath,$imgname);
                $data->img=$imgname;

            }
            $data->save();
            return back()->with('success',$data->name.'Has Been Added');
        } catch (\Throwable $th) {
            return back()->with('error','Something Went Wrong');
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data= Category::find($id);
            return view('backend_app.editcategory',compact('data'));
        } catch (\Throwable $th) {
            return back()->with('Something went wrong');

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            $data=Category::find($id);
        $data->name=$request->name;
        $data->slug=$request->slug;
        if ($request->hasFile('img')) {
            $image=$request->file('img');
            $imgname=$request->file('img')->getClientOriginalName();

            $destinationpath=public_path('assets/category/');
            $image->move($destinationpath,$imgname);
            $data->img=$imgname;

        }
        $data->save();
        return redirect(route('show-category'))->with('success',$data->name.' Has been updated');
        } catch (\Throwable $th) {
           return back()->with('Something went wrong');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data=Category::find($id);
        Category::destroy($id);
        return back()->with('success', $data->name.' Has Been Deleted');
    }
}
