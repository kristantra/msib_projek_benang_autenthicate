@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <!-- Checkout Steps -->
            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Langkah 1: Info pengiriman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Langkah 2: Metode pembayaran</a>
                </li>
            </ul>
            <hr>
            <!-- Shipping Info -->
            <!-- ... -->
        </div>
        <div class="col-md-4 col-xs-12">
            <!-- Order Summary -->
            <div class="card">
                <div class="card-header">
                    Ringkasan pesanan
                </div>
                <ul class="list-group list-group-flush">
                    <!-- Loop through cart items -->
                    @php $total = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                        @php 
                            $total += $details['price'] * $details['quantity'];
                        @endphp
                        <li class="list-group-item">
                            <div class="media">
                                <img src="{{ $details['image'] }}" class="mr-3" alt="...">
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $details['name'] }}</h5>
                                    {{ $details['quantity'] }} item
                                    <br>
                                    <span class="text-danger">Rp&nbsp;{{ number_format($details['price'], 2) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="card-body">
                    <h5 class="card-title">Total pembayaran</h5>
                    <p class="card-text">Rp&nbsp;{{ number_format($total, 2) }}</p>
                    <a href="{{ route('checkout.confirm') }}" class="btn btn-primary">Pilih Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection