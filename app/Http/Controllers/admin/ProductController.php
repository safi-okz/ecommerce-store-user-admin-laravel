<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create() {
        $data = [];

        return view('admin.products.create', $data);
    }
}
