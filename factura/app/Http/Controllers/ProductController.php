<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductResource::collection(Product:: all());

        return $products;
    }
    public function store(Request $request)
    {
        return (new (Product::create($request->all())));
       
    }
}
