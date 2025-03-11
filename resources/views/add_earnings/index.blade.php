@extends('layouts.admin')

@section('title', 'Add Earnings')
@section('content-header', 'Earnings Management')

@section('content')
<style>
    .card-img-top {
        width: 100%;
        height: auto; /* Adjusted for smaller size */
        object-fit: cover;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        text-align: center;
    }
    .earning-title {
        font-size: 18px;
        font-weight: bold;
    }
    .earning-text {
        font-size: 14px;
        color: grey;
    }
</style>

<h3 class="text-center mb-4">Earnings Opportunities</h3>

<div class="row">
    <!-- First Box -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/earnings/refer_earn.jpeg') }}" class="card-img-top" alt="Extra Bonuses">
            <div class="card-body">
                <h5 class="earning-title">Refer and Earn</h5>
                <p class="earning-text">Earn passive income through referrals program</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/earnings/extra_bonus.jpeg') }}" class="card-img-top" alt="Passive Earnings">
            <div class="card-body">
                <h5 class="earning-title">Extra Bonus</h5>
                <p class="earning-text">Unlock extra rewards by completing tasks</p>
            </div>
        </div>
    </div>

    <!-- Second Box -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/earnings/product.jpeg') }}" class="card-img-top" alt="Work-Based Earnings">
            <div class="card-body">
                <h5 class="earning-title">Product Commission</h5>
                <p class="earning-text">Earn commission for every sales</p>
            </div>
        </div>
    </div>

    <!-- Third Box -->
</div>
@endsection
