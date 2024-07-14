<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;

class ProductController extends Controller
{
    public function create() {
        $data = [];
        $categories = Category::orderBy('name', 'ASC')->get();
        $data['categories'] = $categories;

        $brands = Brand::orderBy('name', 'ASC')->get();
        $data['brands'] = $brands;
        return view('admin.products.create', $data);
    }

    public function store(Request $request) {
        dd($request->image_array);
        exit();
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No'
        ];

        if(!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }

          $validator = Validator::make($request->all(), $rules);

          if($validator->passes()){

            $product = new Product;

            $product->name = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->save();

            $request->session()->flash('success','Product added Succefull');

            return response()->json([
                'status' => true,
                'message' => 'Product added succefully'
            ]);

          } else {
            return response()->json([
                'status' => false,
                'error' => $validator->errors()
            ]);
          }
    }
}
