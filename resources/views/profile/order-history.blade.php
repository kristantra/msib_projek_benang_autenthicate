
@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Order History</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Tanggal Pemberian</th>
                        <th>Produk</th>
                        <th>Jumlah Total</th>
                        <th>Status Barang Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                <ul>
                                @foreach($order->orderItems as $item)
                                    <li>
                                        @if(strpos($item->product->image, 'http') !== false)
                                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="img-fluid" style="object-fit: cover; height: 50px;">
                                        @else
                                            <img src="{{ asset('storage/ProductImage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="object-fit: cover; height: 50px;">
                                        @endif
                                        {{ $item->product->name }} (Quantity: {{ $item->quantity }})
                                    </li>
                                @endforeach
                                </ul>
                            </td>
                            <td>
                                @php
                                $totalAmount = 0;
                                foreach($order->orderItems as $item) {
                                    $totalAmount += $item->product->price * $item->quantity;
                                }
                                @endphp
                                Rp. {{ number_format($totalAmount, 0, ',', '.') }}
                            </td>
                            <td>{{ ucfirst($order->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
