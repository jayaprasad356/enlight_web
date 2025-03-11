@extends('layouts.auth')

@section('content')
<div class="card">
    <div class="card-body">
        <h3 class="text-center">{{ __('Reset Password') }}</h3>

        <!-- OTP Form -->
        <form id="otp-form">
            @csrf
            <div class="form-group mb-3">
                <label>{{ __('Mobile Number') }}</label>
                <input type="text" id="mobile" name="mobile" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="button" id="sendOtpButton" class="btn btn-primary">{{ __('Send OTP') }}</button>
            </div>
        </form>

        <!-- OTP Verification Form -->
        <form id="verify-otp-form" style="display: none;">
            <div class="form-group mb-3">
                <label>{{ __('Enter OTP') }}</label>
                <input type="text" id="otp" name="otp" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="button" id="verifyOtpButton" class="btn btn-success">{{ __('Verify OTP') }}</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Send OTP
    $("#sendOtpButton").click(function() {
        var mobile = $("#mobile").val().trim();

        if (mobile.length === 10 && $.isNumeric(mobile)) {
            $.post("{{ route('send.otp') }}", {
                _token: "{{ csrf_token() }}",
                mobile: mobile
            }, function(response) {
                $("#mobile").prop("disabled", true);
                $("#otp-form").hide();
                $("#verify-otp-form").show();
                alert(response.success);
            }).fail(function(xhr) {
                alert(xhr.responseJSON.error);
            });

        } else {
            alert("Please enter a valid 10-digit mobile number.");
        }
    });

    // Verify OTP and Redirect to Reset Password Page
    $("#verifyOtpButton").click(function() {
        var otp = $("#otp").val().trim();
        var mobile = $("#mobile").val().trim();

        if (otp.length === 6 && $.isNumeric(otp)) {
            $.post("{{ route('verify.otp') }}", {
                _token: "{{ csrf_token() }}",
                otp: otp
            }, function(response) {
                alert(response.success);

                // Redirect to Reset Password Page with Mobile & OTP
                window.location.href = "{{ route('password.reset') }}?mobile=" + mobile + "&otp=" + otp;

            }).fail(function(xhr) {
                alert(xhr.responseJSON.error);
            });
        } else {
            alert("Please enter a valid 6-digit OTP.");
        }
    });
});
</script>
@endsection
