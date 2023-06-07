@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Payment Confirmation</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User</th>
                        <th>Order Date</th>
                        <th>Products</th>
                        <th>Payment Confirmation Image</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <ul>
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product->name }} (Quantity: {{ $item->quantity }})</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                            <!-- The clickable thumbnail -->
                            <img src="{{ asset('images/'.$order->payment_confirmation_image) }}" alt="Payment Confirmation" height="50" data-toggle="modal" data-target="#imageModal{{ $order->id }}">

                            <!-- The Modal -->
                            <div class="modal fade" id="imageModal{{ $order->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <!-- The full size image -->
                                            <img src="{{ asset('images/'.$order->payment_confirmation_image) }}" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php
                            $totalAmount = 0;
                            foreach($order->orderItems as $item) {
                                $totalAmount += $item->product->price * $item->quantity;
                            }
                            @endphp
                            {{ number_format($totalAmount, 2) }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.confirm', $order->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    <option value="Pembayaran belum di konfirmasi" {{ $order->status == 'Pembayaran belum di konfirmasi' ? 'selected' : '' }}>Pembayaran belum di konfirmasi</option>
                                    <option value="pembayaran terkonfirmasi" {{ $order->status == 'pembayaran terkonfirmasi' ? 'selected' : '' }}>Pembayaran terkonfirmasi</option>
                                    <option value="pesanan diproses" {{ $order->status == 'pesanan diproses' ? 'selected' : '' }}>Pesanan diproses</option>
                                    <option value="pesanan dikirim" {{ $order->status == 'pesanan dikirim' ? 'selected' : '' }}>Pesanan dikirim</option>
                                    <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
