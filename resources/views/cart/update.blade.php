@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card">
                <img src="{{ $product->image }}" alt="{{ $product->color }}" style="width: 100%; height: auto;">
                <div class="card-body">
                    <h5 class="card-title">Perubahan keranjang pada Produk: {{ $product->name }}</h5>
                    <p class="card-text">Price: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="card-text">Fabric Variant: {{ optional($product->fabricVariant)->name }}</p>
                    <p class="card-text">Fabric Type: {{ optional($product->fabricVariant->fabricType)->name }}</p>
                    <p class="card-text">Description: {{ $product->description }}</p>
                    <p class="card-text">Quantity Available: {{ $product->quantity }} rolls</p>

                    <form method="POST" action="{{ route('cart.update', $product->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                        <div class="form-floating py-3">
                            <input type="number" name="quantity" class="form-control" id="floatingQuantitiy" value="{{ session()->get('cart')[$product->id]['quantity'] }}" min="1" required>
                            <label for="floatingQuantity">Quantity</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Cart</button>

                        @role('user')
                        <a href="{{ route('/') }}" class="btn btn-danger">Checkout</a>
                        @else
                            <a href="{{ route('products.index') }}" class="btn btn-danger">Checkout</a>
                        @endrole 

                    </form>                 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
