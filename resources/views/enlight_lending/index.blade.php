@extends('layouts.admin')

@section('title', 'Enlight Lending')
@section('content-header', 'Enlight Lending')

@section('content')
<div class="container mt-5">

    <!-- Image Section -->
    <div class="row mb-4 text-center">
        <div class="col-md-4">
            <img src="{{ asset('storage/earnings/earnings_1.jpeg') }}" alt="Image 1" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('storage/earnings/earnings_2.jpeg') }}" alt="Image 2" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('storage/earnings/earnings_3.jpeg') }}" alt="Image 3" class="img-fluid rounded shadow">
        </div>
    </div>

    <!-- Description Section -->
    <div class="text-center mb-5">
        <p class="lead">
            Lend Your Money with <strong>Enlight Lending</strong> and earn returns between <strong>5% to 50%</strong> for 30 days. Refer friends and receive <strong>₹500</strong> per referral. 
            Complete <strong>3 referrals</strong> to unlock <strong>50% interest</strong> earnings on your capital. Maximize your returns with this lucrative offer.
        </p>
        <p>
            <strong>Lending Period:</strong> 30 days<br>
            <strong>Returns:</strong> 5%-50%<br>
            <strong>Referral Bonus:</strong> ₹500<br>
            <strong>Unlock 50% interest:</strong> Complete 3 referrals
        </p>
    </div>

    <!-- Lending Section -->
    <div class="bg-light rounded shadow-sm p-4">
        <h3 class="text-center">Enlight Lending</h3>

        <!-- Amount Invested -->
        <div class="mb-4">
            <label for="amount" class="form-label">Lending amount:</label>
            <input type="number" class="form-control" id="amount" value="0" disabled>
            <div class="text-center mt-3">
                <button class="btn btn-success px-5">Lend Now</button>
            </div>
        </div>

        <!-- Referral Link -->
        <div class="mb-4">
            <h4 class="text-center">Your Referral Link</h4>
            <div class="input-group">
                <input type="text" class="form-control" value="https://enlightlending.com/r" readonly>
                <button class="btn btn-secondary" id="copy-btn">Copy</button>
            </div>
        </div>

        <!-- Claim Rewards -->
        <div class="mb-4">
            <h4 class="text-center">Claim Rewards</h4>
            <div class="row g-3">
                <div class="col-6">
                    <button class="btn btn-outline-secondary w-100 py-2">Claim ₹5250</button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success w-100 py-2">Claim ₹2500 (After 3 Referrals)</button>
                </div>
            </div>
        </div>

        <!-- Referral Status -->
        <div class="text-center">
            <p class="fw-bold text-secondary">Successful Referrals: 3/3</p>
        </div>
    </div>
</div>

<script>
    // Copy referral link to clipboard
    document.getElementById('copy-btn').addEventListener('click', () => {
        const link = document.querySelector('input.form-control');
        link.select();
        document.execCommand('copy');
        alert('Referral link copied!');
    });
</script>
@endsection
