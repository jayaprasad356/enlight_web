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
            <img src="{{ asset('storage/earnings/extra_bonus.jpeg') }}" class="card-img-top" alt="Passive Earnings">
            <div class="card-body">
                <h5 class="earning-title">Passive Earnings</h5>
                <p class="earning-text">Earn passive income through referrals and investments.</p>
            </div>
        </div>
    </div>

    <!-- Second Box -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/earnings/product.jpeg') }}" class="card-img-top" alt="Work-Based Earnings">
            <div class="card-body">
                <h5 class="earning-title">Work-Based Earnings</h5>
                <p class="earning-text">Complete tasks and earn bonuses instantly.</p>
            </div>
        </div>
    </div>

    <!-- Third Box -->
    <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('storage/earnings/refer_earn.jpeg') }}" class="card-img-top" alt="Extra Bonuses">
            <div class="card-body">
                <h5 class="earning-title">Extra Bonuses</h5>
                <p class="earning-text">Unlock extra rewards for completing challenges.</p>
            </div>
        </div>
    </div>
</div>
@endsection
