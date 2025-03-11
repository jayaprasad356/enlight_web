@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-center">{{ __('Enter OTP') }}</h3>
        <p class="text-center">OTP has been sent to your mobile number.</p>

        <form method="POST" action="{{ route('password.otp.verify') }}">
            @csrf
            <div class="form-group mb-3">
                <label>{{ __('Enter OTP') }}</label>
                <input type="text" name="otp" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">{{ __('Verify OTP') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection
