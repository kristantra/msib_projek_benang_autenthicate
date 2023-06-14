@extends('layouts.navigation')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
        <div class="col-md-12">
    
            
            @if(session('cart') && count(session('cart')) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Specification</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grand_total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php 
                                $price=$details['price'];
                                $total_price = $details['price'] * $details['quantity'];
                                $grand_total += $total_price;
                            @endphp
                            <tr>
                                <td>
                                    @if(strpos($details['image'], 'http') !== false)
                                        <img src="{{ $details['image'] }}" class="img-fluid" style="object-fit: cover; height: 50px;">
                                    @else
                                        <img src="{{ asset('storage/ProductImage/'.$details['image']) }}" class="img-fluid" style="object-fit: cover; height: 50px;">
                                    @endif
                                </td>
                                
                                <td>{{ $details['name'] }}</td>
                                <td>
                                    
                                    <div><strong>Fabric Variant:</strong> {{ $details['fabric_variant'] }}</div>
                                    <div><strong>Fabric Type:</strong> {{ $details['fabric_type'] }}</div>
                                </td>
                                <td>  Rp. {{ number_format($price, 0, ',', '.') }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>  Rp. {{ number_format($total_price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('cart.edit', $id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>

                                    <form method="POST" action="{{ route('cart.remove', $id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right"><strong>Grand Total:</strong></td>
                            <td colspan="2">  Rp. {{ number_format($grand_total, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>

                <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>

                @if (Auth::check() && Auth::user()->hasRole('user') && !empty(Auth::user()->alamat) && !empty(Auth::user()->phone_number))
                    <!-- The user is authenticated, has 'user' role, and both 'alamat' and 'phone_number' are filled -->
                    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
                @elseif (Auth::guest())
                    <!-- The user is not authenticated -->
                    <a href="{{ route('login') }}" class="btn btn-success">Checkout</a>
                @else
                    <!-- The user is authenticated but does not have 'user' role, or either 'alamat' or 'phone_number' are empty -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#updateProfileModal" class="btn btn-success">Checkout</a>
                @endif
            @else
                <div class="alert alert-info">Your cart is empty. <a href="{{ route('products.index') }}">Shop Now!</a></div>
            @endif
        </div>
    </div>
</div>
@include('modal.update-profile-modal')
@endsection
