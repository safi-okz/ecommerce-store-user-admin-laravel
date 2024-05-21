<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\File;
// use Image;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(10);

        return view('admin.category.list', compact('categories'));
    }

    public function create(){
            return view('admin.category.create');
    }

    public function store(Request $request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'slug' => 'required|unique:categories'
            ]);



            if($validator->passes()) {

                $category = new Category();
                $category->name = $request->name;
                $category->slug = $request->slug;
                $category->status = $request->status;
                $category->image = 'null';
                $category->save();

                if(!empty($request->image_id)) {
                    $tempImage = TempImage::find($request->image_id);
                    $extArray = explode('.', $tempImage->name);
                    $ext = last($extArray);

                    $newImageName = $category->id . '.' . $ext;
                    $sPath = public_path(). '/temp/'. $tempImage->name;
                    $dPath = public_path(). '/uploads/category/'. $newImageName;
                    File::copy($sPath, $dPath);

                    // $dPath = public_path(). '/uploads/category/thumb'. $newImageName;
                    // $img = Image::make($sPath);
                    // $img->resize(450, 600);
                    // $img->save($dPath);

                    $category->image = $newImageName;
                    $category->save();
                } // // "intervention/image": "^3.6"

                $request->session()->flash('success', 'Category added Successfully');

                return response()->json([
                    'status' => true,
                    'message' => "Category added Successfully"
                ]);

            } else {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors()
                ]);
            }
    }

    public function edit($categoryId, Request $request) {
        // echo($categoryId);
        $category = Category::find($categoryId);

        if(empty($category)) {
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit', compact('category'));
    }

    public function update($categoryId, Request $request){

        $category = Category::find($categoryId);

        if(empty($category)) {
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id'
        ]);



        if($validator->passes()) {

            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->image = 'null';
            $category->save();

            if(!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $extArray = explode('.', $tempImage->name);
                $ext = last($extArray);

                $newImageName = $category->id . '.' . $ext;
                $sPath = public_path(). '/temp/'. $tempImage->name;
                $dPath = public_path(). '/uploads/category/'. $newImageName;
                File::copy($sPath, $dPath);

                // $dPath = public_path(). '/uploads/category/thumb'. $newImageName;
                // $img = Image::make($sPath);
                // $img->resize(450, 600);
                // $img->save($dPath);

                $category->image = $newImageName;
                $category->save();
            } // // "intervention/image": "^3.6"

            $request->session()->flash('success', 'Category updated Successfully');

            return response()->json([
                'status' => true,
                'message' => "Category updated Successfully"
            ]);

        } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId, Request $request) {
        $category = Category::find($categoryId);
        if(empty($category)) {
            $request->session()->flash('error', 'Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Category not found to delete it'
            ]);
        }

        $category->delete();

        $request->session()->flash('success', 'Category deleted successflly');

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successflly'
        ]);
    }
}
