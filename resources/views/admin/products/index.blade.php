@extends('layouts.admin')

@section('content')
    


<div class="container">
    <div class="text-center">
        <h1>Our Product Colors</h1>
    </div>

    @role('admin')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
    @endrole

    

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
    </div>
    {{-- until here --}}

    <div class="row mt-3">
        <!-- Add your product cards here. You can loop through your products and create a card for each one. -->
        <!-- Here's an example of what a single card might look like: -->
        @foreach($products as $product)
        <div class="col-md-3">
            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                <div class="card">
                    <!-- Here is your requested change -->
                    <img src="{{ $product->image }}" alt="{{ $product->color }}" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <!-- Display the product name -->
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <!-- Display the price -->
                        <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
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
