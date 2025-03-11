@extends('layouts.auth')

@section('page-title', __('Change Password'))

@section('content')
<div class="card-body">
    <div class="text-center mb-4">
        <h2 class="mb-3">{{ __('Change Password') }}</h2>
        <p>{{ __('You need to change your password before proceeding.') }}</p>
    </div>

    <form method="POST" action="{{ route('force.change.password.post') }}">
        @csrf

        <!-- New Password Field -->
        <div class="form-group mb-3">
            <label class="form-label">{{ __('New Password') }}</label>
            <div class="input-group">
                <input type="password" id="new_password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('new_password', 'eyeIcon1')" style="cursor: pointer; height: 40px;">
                        <i id="eyeIcon1" class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('password')
                <span class="text-danger"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group mb-3">
            <label class="form-label">{{ __('Confirm Password') }}</label>
            <div class="input-group">
                <input type="password" id="confirm_password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                <div class="input-group-append">
                    <span class="input-group-text" onclick="togglePassword('confirm_password', 'eyeIcon2')" style="cursor: pointer; height: 40px;">
                        <i id="eyeIcon2" class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('password_confirmation')
                <span class="text-danger"><small>{{ $message }}</small></span>
            @enderror
        </div>

        <div class="d-grid">
            <button class="btn btn-primary" type="submit">{{ __('Update Password') }}</button>
        </div>
    </form>
</div>

<script>
    // Function to toggle password visibility
    function togglePassword(inputId, eyeIconId) {
        var passwordField = document.getElementById(inputId);
        var eyeIcon = document.getElementById(eyeIconId);

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
