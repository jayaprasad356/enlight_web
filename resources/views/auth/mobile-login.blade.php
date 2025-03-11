@extends('layouts.auth')

@section('page-title', __('Mobile Login'))

@section('content')
<div class="card-body">
    <div class="text-center mb-4">
        <img src="{{ asset('storage/uploads/logo/enlight.jpg') }}" alt="Logo" width="100">
    </div>

    <div>
        <center><h2 class="mb-3 f-w-600">{{ __('Customer Login') }}</h2></center> 
    </div>

    <div class="custom-login-form">
        <form method="POST" action="{{ route('mobile.login') }}">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Mobile Number') }}</label>
                <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter your mobile number" required autofocus>
                @error('mobile')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-danger"><small>{{ $message }}</small></span>
                @enderror
            </div>

            <div class="d-grid">
                <button class="btn btn-primary mt-2" type="submit">{{ __('Login') }}</button>
            </div>

          
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $(".toggle-password").click(function() {
            var target = $(this).data("target");
            var input = $(target);
            var icon = $(this).find("i");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
                icon.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                input.attr("type", "password");
                icon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        // Auto Logout after inactivity
        let timeout;
        function resetTimer() {
            clearTimeout(timeout);
            timeout = setTimeout(logoutUser, 10 * 60 * 1000); // 10 minutes inactivity
        }

        function logoutUser() {
            window.location.href = "{{ route('logout') }}"; // Redirect to logout route
        }

        // Detect user activity
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
        document.onclick = resetTimer;
        document.onscroll = resetTimer;

        resetTimer(); // Initialize timer when page loads
    });
</script>
@endsection
