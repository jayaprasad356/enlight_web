@extends('layouts.admin')

@section('page-title')
    {{ __('Level 1 List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Level 1 List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table" id="pc-dt-simple">
                            <div class="alert" style="position: absolute; top: 10px; right: 10px; font-size: 16px; background-color:#6fd943; color:white; padding: 5px 10px; border-radius: 5px;">
                                <strong>{{ __('Maximum 3 Members You Can Add In Level 1') }}</strong>
                            </div>
                            <thead>
                                <tr>
                                    <th>{{ __('ID') }}</th>
                                    <th>{{ __('Customer Name') }}</th>
                                    <th>{{ __('Mobile') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user['id'] }}</td>
                                        <td>{{ $user['name'] ?? 'N/A' }}</td>
                                        <td>{{ $user['mobile'] ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
