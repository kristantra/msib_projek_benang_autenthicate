@extends('layouts.admin')

@section('content')


    <div class="container">
        <h2>Create Manual Order</h2>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
         @endif
         @if($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
         @endif


        <form action="{{ route('admin.storemanualorder') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="product_id">Product:</label>
                <select name="product_id" id="product_id" class="form-control" onchange="updateAvailableQuantity(this)">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-quantity="{{ $product->quantity }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Available quantity:</label>
                <input type="number" id="availableQuantity" class="form-control" readonly>
            </div>
            

            <div class="form-group">
                <label for="quantity">Order quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control">
            </div>
            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <input type="date" name="order_date" id="order_date" class="form-control">
            </div>
            <div class="form-group">
                <label for="paymentProofUpload">Upload Payment Confirmation(optional):</label>
                <input type="file" name="paymentProofUpload" id="paymentProofUpload" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>

    <script>
        function updateAvailableQuantity(selectElement) {
            var selectedOption = selectElement.options[selectElement.selectedIndex];
            var quantity = selectedOption.getAttribute('data-quantity');
            document.getElementById('availableQuantity').value = quantity;
        }
        window.onload = function() {
            updateAvailableQuantity(document.getElementById('product_id'));
        }
    </script>
    
    
@endsection
