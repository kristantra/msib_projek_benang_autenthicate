<?php

namespace App\Http\Controllers;

use App\Models\FabricType;
use App\Models\FabricVariant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = date('YmdHis') . '.' . $image->extension();
            $request->file('image')->storeAs('ProductImage', $imageName, 'public');

            // Add the image name to the validated data array
            $validated['image'] = $imageName;
        }
        $product = new Product($validated);
        $product->save();

        return redirect()->route('admin.products.index');
    }
    public function show($id)
    {
        $product = Product::with(['fabricVariant', 'fabricVariant.fabricType'])->findOrFail($id);
        return view('products.show', compact('product'));
    }


    public function createFabricType()
    {
        return view('admin.products.createFabricType');
    }

    public function storeFabricType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        $fabricType = new FabricType($validated);
        $fabricType->save();

        return redirect()->route('admin.products.create');
    }

    public function createFabricVariant()
    {
        $fabricTypes = FabricType::all();
        return view('admin.products.createFabricVariant', compact('fabricTypes'));
    }

    public function storeFabricVariant(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:fabric_variants',
            'fabric_type_id' => 'required|exists:fabric_types,id'
        ]);

        $fabricVariant = new FabricVariant($validated);
        $fabricVariant->save();

        return redirect()->route('admin.products.create');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $fabricTypes = FabricType::all();
        $fabricVariants = FabricVariant::all();

        return view('admin.products.edit', compact('product', 'fabricTypes', 'fabricVariants'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required',
            'fabric_type_id' => 'required',
            'fabric_variant_id' => 'required',
            'color_code' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image file
            Storage::disk('public')->delete('ProductImage/' . $product->image);

            // Handle new image upload
            $image = $request->file('image');
            $imageName = date('YmdHis') . '.' . $image->extension();
            $request->file('image')->storeAs('ProductImage', $imageName, 'public');

            // Add the image name to the validated data array
            $validated['image'] = $imageName;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index');
    }



    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete the associated image file
        Storage::disk('public')->delete('ProductImage/' . $product->image);

        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'Product deleted successfully!');
    }
}
