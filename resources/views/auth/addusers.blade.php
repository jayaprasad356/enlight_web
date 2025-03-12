@php
    $refer_code = session('refer_code', ''); // Get refer_code from session or empty string if not set
@endphp

@extends('layouts.auth')

@section('page-title', __('Mobile Login'))

@section('content')
<div class="card-body">
    <div class="text-center mb-4">
        <img src="{{ asset('storage/uploads/logo/enlight.jpg') }}" alt="Logo" width="100">
    </div>

    <div>
        <center><h2 class="mb-3 f-w-600">{{ __('Customer Register') }}</h2></center> 
    </div>

    <div class="custom-login-form">
        <form action="{{ route('addusers') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="mobile">{{ __('Mobile') }}</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required value="{{ old('mobile') }}">
                @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="age">{{ __('Age') }}</label>
                <input type="number" class="form-control" id="age" name="age" required value="{{ old('age') }}">
                @error('age') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="pincode">{{ __('Pincode') }}</label>
                <input type="text" class="form-control" id="pincode" name="pincode" required value="{{ old('pincode') }}">
                @error('pincode') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="gender">{{ __('Gender') }}</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="">{{ __('Select Gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                </select>
                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="level_1_refer">{{ __('Level 1 Refer') }}</label>
                <input type="text" class="form-control" id="level_1_refer" name="level_1_refer" value="{{ $refer_code }}" disabled>
                @error('level_1_refer') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary">{{ __('Register Customer') }}</button>
            </div>
        </form>
    </div>
</div>

@endsection

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
