@extends('layouts.admin')

@section('title', 'Products Management')
@section('content-header', 'Products Management')
@section('content-actions')
@endsection
@section('content')
<style>
    .card-img-top {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .stars {
        color:#6fd943;
        font-size: 25px;
    }
    .discount {
        color: #6fd943;
        font-weight: bold;
    }
    .original-price {
        text-decoration: line-through;
        color: grey;
    }
    .final-price {
        font-weight: bold;
        font-size: 18px;
     
    }
    .free-delivery {
        color: blue;
        font-weight: bold;
    }
    .price-container {
        display: flex;
        gap: 10px;
        align-items: center;
    }
</style>

<h3>My Products</h3>
<div class="recharge-balance" style="position: absolute; top: 10px; right: 10px; font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
    <strong>{{ __('Available Balance: Rs') }} {{ $purchase_wallet }}</strong>
</div>
<br>
<div class="row">
  
    @foreach ($products as $product)
    <div class="col-md-3">
        <div class="card">
            <img src="{{ asset('admin/storage/app/public/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="stars">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
                <div class="price-container">
                    <p class="discount">&#x2193; {{ round((($product->amount - $product->offer) / $product->amount) * 100) }}% OFF</p>
                    <p class="original-price">₹{{ $product->amount }}</p>
                    <p class="final-price">₹{{ $product->offer }}</p>
                </div>
                <p class="free-delivery">🚚 Free Delivery</p>
                <a href="#" class="btn btn-primary purchase-btn">Purchase</a>
            </div>
        </div>
    </div>
@endforeach

</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.purchase-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent any default behavior
            alert("You are allowed to purchase products only on earning your monthly salary");
        });
    });
});
</script>
