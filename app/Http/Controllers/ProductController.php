<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $fabricTypeId = $request->input('fabric_type_id');
        $products = Product::query()->with('fabricType');

        if ($sort == 'fabricType' && $fabricTypeId) {
            $products = $products->where('fabric_type_id', $fabricTypeId);
        }

        $products = $products->orderBy('id')->paginate(12);
        $fabricTypes = FabricType::all();
        return view('products.index', compact('products', 'fabricTypes'));
    }

    public function index2(Request $request)
    {
        $sort = $request->input('sort');
        $fabricTypeId = $request->input('fabric_type_id');
        $products = Product::query()->with('fabricType');

        if ($sort == 'fabricType' && $fabricTypeId) {
            $products = $products->where('fabric_type_id', $fabricTypeId);
        }

        $products = $products->orderBy('id')->get(); // get all products at once
        $fabricTypes = FabricType::all();
        return view('bukan_admin.product.index2', compact('products', 'fabricTypes'));
    }
}
