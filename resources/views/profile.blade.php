@extends('layouts.admin')

@section('page-title')
    {{ __('Profile') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Profile') }}</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <div class="profile-avatar mb-3">
                        <img src="{{ asset('storage/uploads/avatar/avatar.png') }}" 
                            class="rounded-circle border border-3 shadow-sm"
                            style="width: 120px; height: 120px;" 
                            alt="User Avatar">
                    </div>
                    <h3 class="mb-1">{{ $user->name }}</h3>
                    <p class="text-muted">{{ __('User Profile Details') }}</p>
                    
                    <table class="table table-hover mt-4">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-user text-primary"></i> {{ __('Name') }}</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-phone-alt text-success"></i> {{ __('Mobile') }}</th>
                                <td>{{ $user->mobile }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar-alt text-warning"></i> {{ __('Age') }}</th>
                                <td>{{ $user->age }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-map-marker-alt text-danger"></i> {{ __('Pincode') }}</th>
                                <td>{{ $user->pincode }}</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-venus-mars text-info"></i> {{ __('Gender') }}</th>
                                <td>{{ ucfirst($user->gender) }}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to Dashboard') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FontAwesome for Icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
@endsection
