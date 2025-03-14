@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection

@php
    $setting = App\Models\Utility::settings();
@endphp

@section('content')
    <div class="row">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="col-xxl-12">
            <div class="row">
                <!-- Total Users -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-users"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Total') }}</small>
                                            <h6 class="m-0">{{ __('Users') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-primary">{{ $total_users }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 1 Activated Today -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-success">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today Activated') }}</small>
                                            <h6 class="m-0">{{ __('Level 1') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-success">{{ $today_level_1 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 2 Activated Today -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today Activated') }}</small>
                                            <h6 class="m-0">{{ __('Level 2') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-info">{{ $today_level_2 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 3 Activated Today -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-warning">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today Activated') }}</small>
                                            <h6 class="m-0">{{ __('Level 3') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-warning">{{ $today_level_3 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 4 Activated Today -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-danger">
                                            <i class="ti ti-user-check"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today Activated') }}</small>
                                            <h6 class="m-0">{{ __('Level 4') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-danger">{{ $today_level_4 }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today Registrations -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-primary">
                                            <i class="ti ti-user-plus"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today') }}</small>
                                            <h6 class="m-0">{{ __('Registrations') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-primary">{{ $today_registration }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unpaid Withdrawals -->
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-secondary">
                                            <i class="ti ti-cash"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Pending Unpaid') }}</small>
                                            <h6 class="m-0">{{ __('Withdrawals') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-secondary">{{ number_format($unpaid_withdrawals, 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-info">
                                        <i class="ti ti-clock"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Pending Recharge') }}</small>
                                            <h6 class="m-0">{{ __('Request') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-secondary">{{ $pending_recharge }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-auto mb-3 mb-sm-0">
                                    <div class="d-flex align-items-center">
                                        <div class="theme-avtar bg-danger">
                                        <i class="ti ti-cash"></i>
                                        </div>
                                        <div class="ms-3">
                                            <small class="text-muted">{{ __('Today Recharge') }}</small>
                                            <h6 class="m-0">{{ __('Amount') }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end">
                                    <h4 class="m-0 text-secondary">{{ number_format($today_recharge_amount, 0) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

<script>
    let logoutTimer;

    function resetTimer() {
        clearTimeout(logoutTimer);
        logoutTimer = setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 300000); // 5 minutes
    }

    document.onload = resetTimer();
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
</script>

