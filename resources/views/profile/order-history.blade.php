
@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Order History</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Nomor</th>
                        <th class="text-center">Tanggal Pembelian</th>
                        <th class="text-center">Produk</th>
                        <th class="text-center">Jumlah Total</th>
                        <th class="text-center">Status Barang Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $order->created_at }}</td>
                            <td class="text-center">
                                <ul class="list-unstyled">
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
                            <td class="text-center">
                                @php
                                $totalAmount = 0;
                                foreach($order->orderItems as $item) {
                                    $totalAmount += $item->product->price * $item->quantity;
                                }
                                @endphp
                                Rp. {{ number_format($totalAmount, 0, ',', '.') }}
                            </td>
                            <td class="text-center">{{ ucfirst($order->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
