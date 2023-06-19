@extends('layouts.admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-auto">
        <h2>Warehouse Management</h2>
        <table class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th class="text-center">Product Name (Fabric Variant)</th>
                        <th class="text-center">Available Quantity</th>
                        <th class="text-center">Sold Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Product Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td class="text-center">
                            <p>{{ $product->name }}</p>
                            <p>({{ $product->fabricVariant->fabricType->name }})</p>
                            <p>({{ $product->fabricVariant->name }})</p>
                        </td>
                        
                        <td class="text-center">{{ $product->quantity }}</td>
                        <td class="text-center">{{ $product->orderItems->sum('quantity') }}</td>
                        <td class="text-nowrap">Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $product->description }}</td>
                        {{--       <img src="{{ asset('images/'.$order->payment_confirmation_image) }}" alt="Payment Confirmation" height="50" data-toggle="modal" data-target="#imageModal{{ $order->id }}"> --}}
                        <td class="text-center">
                            @if(strpos($product->image, 'http') !== false)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid" style=" height: 50px;">
                            @else
                                <img src="{{ asset('storage/ProductImage/'.$product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="object-fit: cover; height: 50px">
                            @endif
                        </td>
                        
                        <td class="text-center">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> </button>
                            </form>
                        </td>
                        
                        
                    </tr>
                    @endforeach
                </tbody>
        </table>
        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
