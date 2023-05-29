@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
          @endif
            @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->color }}" style="width: 100%; height: auto;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="card-text">Fabric Variant: {{ optional($product->fabricVariant)->name }}</p>
                    <p class="card-text">Fabric Type: {{ optional($product->fabricVariant->fabricType)->name }}</p>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Quantity Available: {{ $product->quantity }} rolls</p>

                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <div class="form-floating py-3">
                            <input type="number" name="quantity" class="form-control" id="floatingQuantitiy" placeholder="Quantity" required>
                            <label for="floatingQuantitiy">Quantity</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah keranjang</button>

                        @role('user')
                        <a href="{{ route('checkout') }}" class="btn btn-danger">Checkout</a>
                        @else
                            <a href="{{ route('products.index') }}" class="btn btn-danger">Checkout</a>
                        @endrole 

                    </form>
                    
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        $('#add-to-cart-form').on('submit', function(e) {
                            if ($('#floatingQuantitiy').val() === '') {
                                e.preventDefault();
                                alert('Please enter a quantity.');
                            }
                        });
                    });
                    </script>
            
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
