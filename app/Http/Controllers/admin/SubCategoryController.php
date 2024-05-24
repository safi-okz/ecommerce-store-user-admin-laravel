<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{

    public function index(){
        $subCategories = SubCategory::select('sub_categories.*', 'categories.name as categoryName')
        ->latest('id')->leftJoin('categories', 'categories.id', 'sub_categories.category_id')
        ->paginate(10);

            return view('admin.sub_category.list', compact('subCategories'));
    }
    public function create() {
        $category = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $category;
        return view('admin.sub_category.create', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'status' => 'required',
            'category' => 'required'
        ]);

        if($validator->passes()) {

            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->save();

            $request->session()->flash('success', 'Sub Category created successfully');

            return response()->json([
                'status' => true,
                'message' => 'Sub Category created successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request) {
        $subCategory = SubCategory::find($id);

        if(empty($subCategory)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('sub-categories.index');
        }

        $category = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $category;
        $data['subCategory'] = $subCategory;
        return view('admin.sub_category.edit', $data);

    }
}
