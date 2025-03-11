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
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#new_password">
                    <i class="fas fa-eye"></i>
                </button>
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
                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#confirm_password">
                    <i class="fas fa-eye"></i>
                </button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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
    });
</script>
@endsection
