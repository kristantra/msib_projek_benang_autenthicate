@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Product</h2>
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="product-name">Product Name</label>
                <input type="text" class="form-control" id="product-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="fabric-type">Fabric Type</label>
                <select class="form-control" id="fabric-type" name="fabric_type_id">
                    @foreach($fabricTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                  {{-- add Fabric Variant button + it's route please --}}

            </div>
            <div class="form-group">
                <label for="fabric-variant">Fabric Variant</label>
                <select class="form-control" id="fabric-variant" name="fabric_variant_id">
                    @foreach($fabricVariants as $variant)
                        <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                    @endforeach
                </select>
                  {{-- add Fabric Variant button + it's route please --}}
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
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
            </div>
            <div class="form-group">
                <label for="quantity">Price</label>
                <input type="number" class="form-control" id="quantity" name="price" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
