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
                    <div class="input-group-append">
                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer; height: 40px;">
                            <i id="eyeIcon" class="fas fa-eye"></i>
                        </span>
                    </div>
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

<script>
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

    // Toggle password visibility
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>

@endsection
