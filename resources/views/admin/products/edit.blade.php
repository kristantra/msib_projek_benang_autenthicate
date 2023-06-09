@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label for="fabric_type_id">Fabric Type</label>
            <select class="form-control" id="fabric_type_id" name="fabric_type_id">
                @foreach ($fabricTypes as $fabricType)
                    <option value="{{ $fabricType->id }}" {{ $product->fabric_type_id == $fabricType->id ? 'selected' : '' }}>
                        {{ $fabricType->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="fabric_variant_id">Fabric Variant</label>
            <select class="form-control" id="fabric_variant_id" name="fabric_variant_id">
                @foreach ($fabricVariants as $fabricVariant)
                    <option value="{{ $fabricVariant->id }}" {{ $product->fabric_variant_id == $fabricVariant->id ? 'selected' : '' }}>
                        {{ $fabricVariant->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="color_code">Color Code</label>
            <input type="text" class="form-control" id="color_code" name="color_code" value="{{ $product->color_code }}">
        </div>

        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            <small class="form-text text-muted">If you want to change the product image, choose a new one. Otherwise, leave this blank.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
@endsection
