<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use App\Models\FabricVariant;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Traits\HasRoles;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort');
        $fabricTypeId = $request->input('fabric_type_id');
        $products = Product::query()->with(['fabricVariant', 'fabricVariant.fabricType']);

        if ($sort == 'fabricType' && $fabricTypeId) {
            $products = $products->whereHas('fabricVariant', function ($query) use ($fabricTypeId) {
                $query->where('fabric_type_id', $fabricTypeId);
            });
        }

        $products = $products->orderBy('id')->paginate(12);
        $fabricTypes = FabricType::all();


        return view('products.index', compact('products', 'fabricTypes'));
    }

    public function indexAdmin(Request $request)
    {
        $sort = $request->input('sort');
        $fabricTypeId = $request->input('fabric_type_id');
        $products = Product::query()->with(['fabricVariant', 'fabricVariant.fabricType']);

        if ($sort == 'fabricType' && $fabricTypeId) {
            $products = $products->whereHas('fabricVariant', function ($query) use ($fabricTypeId) {
                $query->where('fabric_type_id', $fabricTypeId);
            });
        }

        $products = $products->orderBy('id')->paginate(12);
        $fabricTypes = FabricType::all();


        return view('admin.products.index', compact('products', 'fabricTypes'));
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
    public function create()
    {
        $fabricTypes = FabricType::all();
        $fabricVariants = FabricVariant::all();

        return view('admin.products.create', compact('fabricTypes', 'fabricVariants'));
    }

    public function store(Request $request)
    {
        // The validation here can be much more specific
        // Make sure to handle file uploads (for the product image) appropriately
        $validated = $request->validate([
            'name' => 'required',
            'fabric_type_id' => 'required',
            'fabric_variant_id' => 'required',
            'color_code' => 'required',
            'description' => 'required',
            'image' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $product = new Product($validated);
        $product->save();

        return redirect()->route('admin.products.index');
    }
    public function show($id)
    {
        $product = Product::with(['fabricVariant', 'fabricVariant.fabricType'])->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
