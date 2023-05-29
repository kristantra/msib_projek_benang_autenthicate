@extends('layouts.navigation')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <!-- Checkout Steps -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#shippingInfo" data-toggle="collapse">1 Info Pengiriman</a>
                    </div>
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#paymentMethod" data-toggle="collapse">2 Metode Pembayaran</a>
                    </div>
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#paymentProof" data-toggle="collapse">3 Upload Bukti Pembayaran</a>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Shipping Info -->
            <div id="shippingInfo" class="collapse">
                <h4>Info Pengiriman</h4>
                <form>
                    <div class="form-group">
                        <label for="userName">Nama</label>
                        <input type="text" class="form-control" id="userName" placeholder="Nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" placeholder="Email Anda">
                    </div>
                    <div class="form-group">
                        <label for="userPhone">Telepon</label>
                        <input type="tel" class="form-control" id="userPhone" placeholder="Nomor Telepon Anda">
                    </div>
                    <div class="form-group">
                        <label for="userAddress">Alamat</label>
                        <input type="text" class="form-control" id="userAddress" placeholder="Alamat Anda">
                    </div>
                    <button type="submit" class="btn btn-primary">Lanjutkan ke Metode Pembayaran</button>
                </form>
            </div>

            <!-- Payment Method -->
            <div id="paymentMethod" class="collapse">
                <h4>Metode Pembayaran</h4>
                <form>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentOption" id="bankTransfer" value="bankTransfer" checked>
                        <label class="form-check-label" for="bankTransfer">
                            Transfer Bank BCA
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentOption" id="transferOVO" value="transferOVO">
                        <label class="form-check-label" for="transferOVO">
                            Transfer OVO
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentOption" id="transferGOPAY" value="transferGOPAY">
                        <label class="form-check-label" for="transferGOPAY">
                            Transfer GOPAY
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Lanjutkan ke Upload Bukti Pembayaran</button>
                </form>
            </div>

            <!-- Upload Proof of Payment -->
            <div id="paymentProof" class="collapse">
                <h4>Upload Bukti Pembayaran</h4>
                <form>
                    <div class="form-group">
                        <label for="paymentProofUpload">File Bukti Pembayaran</label>
                        <input type="file" class="form-control-file" id="paymentProofUpload">
                    </div>
                    <button type="submit" class="btn btn-primary">Selesaikan Pembayaran</button>
                </form>
            </div>
        </div>
        <!-- Your summary card goes here... -->

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
                                <div class="media-body" >
                                    <h5 class="mt-0">{{ $details['name'] }}</h5>
                                    {{ $details['quantity'] }} rolls
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

<style>
    .step-link {
    display: block;
    padding: 10px 20px;
    background-color: #eee;
    border-radius: 20px;
    color: #333;
    text-decoration: none;
}
</style>
@endsection



