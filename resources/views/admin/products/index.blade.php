@extends('layouts.admin')

@section('content')
    

<div class="container">
    <div class="text-center">
        <h1>Our Product Colors</h1>
    </div>
    <div class="col-md-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    @role('admin')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    @endrole

    
{{-- 
    <div class="d-flex justify-content-end">
        <div class="dropdown mr-2">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="fabricDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Fabric Types
            </button>
            <div class="dropdown-menu" aria-labelledby="fabricDropdown">
                <!-- Add your fabric types here -->
                @foreach ($fabricTypes as $fabricType)
                    <a class="dropdown-item" href="{{ route('products.index', ['sort' => 'fabricType', 'fabric_type_id' => $fabricType->id]) }}">
                        {{ $fabricType->name }}
                    </a>
                @endforeach
            </div>
        </div>        
    </div> --}}
    {{-- until here --}}

    <div class="row mt-3">
        <!-- Add your product cards here. You can loop through your products and create a card for each one. -->
        <!-- Here's an example of what a single card might look like: -->
        @foreach($products as $product)
        <div class="col-md-3 py-3">
            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="card">
                    <!-- Here is your requested change -->
                    @if(strpos($product->image, 'http') !== false)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"  class="img-fluid" style="object-fit: cover; height: 100%;">
                @else
                    <img src="{{ asset('storage/ProductImage/'.$product->image) }}" alt="{{ $product->name }}"  class="img-fluid" style="object-fit: cover; height: 100%;">
                @endif
                    <div class="card-body">
                        <!-- Display the product name -->
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <!-- Display the price -->
                        <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    {{-- role admin --}}
                    @role('admin') <!-- Add the buttons only for admins -->
                    <div class="mt-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', $product->id) }}" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>

                        </form>
                    </div>
                    @endrole
                </div>
            </a>
        </div>
        @endforeach
        
       
    </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>
</div>
@endsection
