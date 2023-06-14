@extends('layouts.navigation')

@section('content')
@php 
    $total = 0;
    foreach(session('cart') as $id => $details){
        $total += $details['price'] * $details['quantity'];
    }
@endphp

<div class="container">
    <div class="row">
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
        <div class="col-md-8 col-xs-12">
            <!-- Checkout Steps -->
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#" onclick="toggleVisibility('shippingInfo')">1 Info Pengiriman</a>
                    </div>
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#" onclick="toggleVisibility('paymentMethod')">2 Metode Pembayaran</a>
                    </div>
                    <div class="p-2 flex-fill">
                        <a class="step-link" href="#" onclick="toggleVisibility('paymentProof')">3 Upload Bukti Pembayaran</a>
                    </div>
                </div>
            </div>
            <hr>

            <!-- Shipping Info -->
          <!-- Shipping Info -->
            <div id="shippingInfo" class="collapse show">
            <h4>Info Pengiriman</h4>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="userName">Nama</label>
                    <input type="text" class="form-control" id="userName" value="{{ old('name', Auth::user()->name) }}" name="name">
                </div>
                <div class="form-group">
                    <label for="userEmail">Email</label>
                    <input type="email" class="form-control" id="userEmail" value="{{ old('email', Auth::user()->email) }}" name="email">
                </div>
                <div class="form-group">
                    <label for="userPhone">Telepon</label>
                    <input type="tel" class="form-control" id="userPhone" value="{{ old('phone_number', Auth::user()->phone_number) }}" name="phone_number">
                </div>
                <div class="form-group">
                    <label for="userAddress">Alamat</label>
                    <input type="text" class="form-control" id="userAddress" value="{{ old('alamat', Auth::user()->alamat) }}" name="alamat">
                </div>
                <button type="submit" class="btn btn-primary">Simpan dan Lanjutkan ke Metode Pembayaran</button>
            </form>
            </div>
        
        


            <!-- Payment Method -->
            <div id="paymentMethod" class="collapse">
                <h4>Metode Pembayaran</h4>
                <div class="payment-instruction">
                    <p>Untuk melakukan pembayaran, silahkan transfer ke:</p>
                    <p><strong>Bank BCA</strong></p>
                    <p>No. Rekening: <strong>0181584750</strong></p>
                    <p>Atas Nama: <strong>Dwi Krisna Tantra</strong></p>
                    <p class="total-payment">Total Pembayaran: Rp&nbsp;{{ number_format($total, 2) }}</p>
                    <p>Setelah transfer, mohon untuk melakukan screenshot sebagai bukti pembayaran. Bukti pembayaran dapat diunggah di langkah selanjutnya.</p>
                    <button type="button" class="btn btn-primary" onclick="toggleVisibility('paymentProof')">Lanjutkan ke Upload Bukti Pembayaran</button>
                </div>
            </div>
            

            <!-- Upload Proof of Payment -->
            <div id="paymentProof" class="collapse">
                <h4>Upload Bukti Pembayaran</h4>
                <form method="POST" action="{{ route('checkout.confirm') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="paymentProofUpload">File Bukti Pembayaran</label>
                        <input type="file" class="form-control-file" id="paymentProofUpload" name="paymentProofUpload">
                        <img id="paymentProofPreview" src="" alt="your image" style="max-width: 200px; max-height: 200px;"/>
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
                                @if(strpos($details['image'], 'http') !== false)
                                    <img src="{{ $details['image'] }}" class="mr-3 img-fluid">
                                @else
                                    <img src="{{ asset('storage/ProductImage/' . $details['image']) }}" class="mr-3 img-fluid">
                                @endif
                                <div class="media-body" >
                                    <h5 class="mt-0">{{ $details['name'] }}</h5>
                                    {{ $details['quantity'] }} rolls
                                    <br>
                                    <span class="text-danger">Rp&nbsp;{{ number_format($details['price'],  2) }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="card-body">
                    <h5 class="card-title">Total pembayaran</h5>
                    <p class="card-text">Rp&nbsp;{{ number_format($total, 2) }}</p>
                   
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
.active-step {
    background-color: aqua;
    color: #333;
}
.payment-instruction {
    background-color: #f8f9fa;
    border: 1px solid #e9ecef;
    padding: 15px;
    border-radius: 5px;
}

.payment-instruction p {
    margin: 0 0 10px;
    line-height: 1.5;
}

.payment-instruction .total-payment {
    font-size: 20px;
    color: #dc3545;
    margin-top: 15px;
    margin-bottom: 15px;
}

</style>
<script>
   function toggleVisibility(id) {
    var allSections = ['shippingInfo', 'paymentMethod', 'paymentProof'];
    var stepLinks = document.getElementsByClassName('step-link');
    for (var i = 0; i < allSections.length; i++) {
        var element = document.getElementById(allSections[i]);
        if (allSections[i] == id) {
            element.classList.add('show');
            stepLinks[i].classList.add('active-step'); // Highlight active step
        } else {
            element.classList.remove('show');
            stepLinks[i].classList.remove('active-step'); // Remove highlight from other steps
        }
    }
}
document.getElementById('paymentProofUpload').addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function() {
        var img = document.getElementById('paymentProofPreview');
        img.src = reader.result;
    }
    reader.readAsDataURL(e.target.files[0]);
});

</script>

@endsection