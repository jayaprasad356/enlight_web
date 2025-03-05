@extends('layouts.admin')

@section('page-title')
    {{ __('Add Payment Screenshot') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('payment_screenshots.index') }}">{{ __('Payment Screenshot') }}</a></li>
    <li class="breadcrumb-item">{{ __('Add Payment Screenshot') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Add New Payment Screenshot') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('payment_screenshots.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @error('gift_icon')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="image" class="form-label">{{ __('Payment Screenshot') }}</label>
                        <input type="file" name="screenshots" class="form-control" required>
                    </div>

                    <div class="form-group mt-4 text-center">
                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        <a href="{{ route('payment_screenshots.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
