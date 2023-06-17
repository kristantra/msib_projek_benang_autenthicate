@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Product</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
         @endif
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">Product Name</label>
                <input type="text" class="form-control" id="product-name" name="name" required>
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="fabric-type">Fabric Type</label>
                <select class="form-control" id="fabric-type" name="fabric_type_id">
                    @foreach($fabricTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('admin.fabricTypes.create') }}" class="btn btn-success mt-2">Add Fabric Types</a>

            </div>
            <div class="form-group">
                <label for="fabric-variant">Fabric Variant</label>
                <select class="form-control" id="fabric-variant" name="fabric_variant_id">
                    @foreach($fabricVariants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                    @endforeach
                </select>
                <a href="{{ route('admin.fabricVariants.create') }}" class="btn btn-success mt-2">Add Fabric Variants</a>
            </div>
            <div class="form-group">
                <label for="color-code">Color Code</label>
                <input type="text" class="form-control" id="color-code" name="color_code" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control-file" id="image" name="image">
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
                @error('quantity')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
                @error('price')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
