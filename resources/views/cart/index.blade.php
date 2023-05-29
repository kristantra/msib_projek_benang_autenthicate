@extends('layouts.navigation')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                            $total_price = $details['price'] * $details['quantity'];
                            $grand_total += $total_price;
                        @endphp
                        <tr>
                            <td><img src="{{ $details['image'] }}" width="50" height="50" class="img-responsive"/></td>
                            <td>{{ $details['name'] }}</td>
                            <td>
                                <div><strong>Fabric Variant:</strong> {{ $details['fabric_variant'] }}</div>
                                <div><strong>Fabric Type:</strong> {{ $details['fabric_type'] }}</div>
                            </td>
                            <td>{{ $details['price'] }}</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ $total_price }}</td>
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
                        <td colspan="2">{{ $grand_total }}</td>
                    </tr>
                </tfoot>
            </table>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
         

            @if (Auth::check() && Auth::user()->hasRole('user'))
            <!-- The user is authenticated and has 'user' role -->
            <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
        @else
            <!-- The user is not authenticated or does not have 'user' role -->
            <a href="{{ route('register') }}" class="btn btn-success">Checkout</a>
        @endif
        
          
            
        </div>
    </div>
</div>
@endsection
