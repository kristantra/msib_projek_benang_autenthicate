@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales Report</h3>
        </div>
        <div class="card-body">
            <h4>Total Revenue</h4>
            <p>Daily: {{ $totalRevenue['daily'] }}</p>
            <p>Weekly: {{ $totalRevenue['weekly'] }}</p>
            <p>Monthly: {{ $totalRevenue['monthly'] }}</p>
            <p>Yearly: {{ $totalRevenue['yearly'] }}</p>

            <h4>Most Sold Products</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Sales</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productSales as $productId => $data)
                        <tr>
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['quantity'] }}</td>
                            <td>{{ $data['total_sales'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Unsold Products</h4>
            @if($unsoldProducts->isEmpty())
                <p>All products have been sold at least once.</p>
            @else
                <ul>
                    @foreach($unsoldProducts as $product)
                        <li>{{ $product->name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

@endsection
