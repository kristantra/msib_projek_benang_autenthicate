@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sales Report</h3>
        </div>
        <div class="card-body">
            <h4>Total Revenue</h4>
            <p>Daily: Rp.  {{number_format($totalRevenue['daily'], 0, ',', '.')}} </p>
            <p>Weekly: Rp.{{number_format($totalRevenue['weekly'], 0, ',', '.')}} </p>
            <p>Monthly: Rp. {{ number_format($totalRevenue['monthly'] , 0, ',', '.')}}</p>
            <p>Yearly: Rp.{{number_format($totalRevenue['yearly'], 0, ',', '.')  }}</p>

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
                      
                            <td>{{ $data['name'] }}</td>
                            <td>{{ $data['quantity'] }}</td>
                            <td>Rp. {{ number_format($data['total_sales'], 0, ',', '.') }}</td>
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
