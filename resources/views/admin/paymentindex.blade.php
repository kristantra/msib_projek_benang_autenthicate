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
                     
                        <th class="text-center">User</th>
                        <th class="text-center">Order Date</th>
                        <th class="text-center">Products</th>
                        <th class="text-center">Payment Confirmation Image</th>
                        <th class="text-center">Total Amount</th>
                        <th class="text-center">Action</th>
                        <th class="text-center">Function</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                   
                        <td class="text-center">{{ $order->user->name }}</td>
                        <td class="text-center">{{ $order->order_date }}</td>
                        <td class="text-center">
                            <ul>
                            @foreach($order->orderItems as $item)
                                <li>{{ $item->product->name }} (Quantity: {{ $item->quantity }})</li>
                            @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
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
                        <td class="text-center">
                            @php
                            $totalAmount = 0;
                            foreach($order->orderItems as $item) {
                                $totalAmount += $item->product->price * $item->quantity;
                            }
                            @endphp
                            
                            Rp. {{ number_format($totalAmount, 0, ',', '.') }}
                        </td>
                        <td class="text-center">
                            <form method="POST" action="{{ route('admin.confirm', $order->id) }}">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    @if($order->status == "Pembayaran melalui tokopedia")
                                        <option value="pembayaran melalui tokopedia" selected disabled>Pembayaran melalui tokopedia</option>
                                    @else
                                        <option value="Pembayaran belum di konfirmasi" {{ $order->status == 'Pembayaran belum di konfirmasi' ? 'selected' : '' }}>Pembayaran belum di konfirmasi</option>
                                        <option value="pembayaran terkonfirmasi" {{ $order->status == 'pembayaran terkonfirmasi' ? 'selected' : '' }}>Pembayaran terkonfirmasi</option>
                                        <option value="pesanan diproses" {{ $order->status == 'pesanan diproses' ? 'selected' : '' }}>Pesanan diproses</option>
                                        <option value="pesanan dikirim" {{ $order->status == 'pesanan dikirim' ? 'selected' : '' }}>Pesanan dikirim</option>
                                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    @endif
                                </select>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Start Pagination -->
             <div class="d-flex justify-content-center mt-3">
                {{ $orders->links() }}
            </div>
            <!-- End Pagination -->
        </div>
    </div>
</div>
@endsection
