<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request) {
        if(!empty($request->category_id)) {
            $subcategories = SubCategory::where('category_id', $request->category_id)
        ->orderBy('name', 'ASC')->get();

        return response()->json([
            'status' => true,
            'subcategories' => $subcategories
        ]);
        } else {
            return response()->json([
                'status' => true,
                'subcategories' => []
            ]);
        }
}
}
