<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories');
    }

    public function getCategories(Request $request)
    {
        if($request->ajax()){
            $categories = Category::query();
            // $data = Category::latest()->get();
            return Datatables::eloquent($categories)
                // ->orderColumn('created_at','asc')
                ->order(function ($query) {
                    $query->orderBy('created_at', 'desc');
                })
                ->addIndexColumn()
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->ajax()){
            $request->validate([
                'category_name' => 'required',
            ]);

            $newCategory = Category::create([
                'category_name' => $request->category_name,
            ]);

            if($newCategory->wasRecentlyCreated){
                return Response::json($newCategory->category_name.', Successfully Created!');
            }
            return Response::json($newCategory);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if($request->ajax()){
            $updatedCategory = Category::where('id', $category->id)->update([
                'category_name' => $request->category_name,
            ]);

            if($updatedCategory){
                return Response::json('Updated Successfully!');
            }
            return Response::json($updatedCategory);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(request()->ajax()){
            $deletedCategory = Category::destroy($category->id);
            if($deletedCategory){
                return Response::json('Successfully Deleted!');
            }
            return Response::json($deletedCategory);
        }
    }
}
