@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Orders') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Orders') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Orders List') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Product Image') }}</th>
                                <th>{{ __('Product Name') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('User Mobile') }}</th>
                                <th>{{ __('Address') }}</th>
                                <th>{{ __('Datetime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>

                                    {{-- Handle product image with null check --}}
                                    <td>
                                        @if(optional($order->product)->image)
                                            <a href="{{ asset('storage/app/public/' . $order->product->image) }}" data-lightbox="image-{{ $order->id }}">
                                                <img class="customer-img img-thumbnail img-fluid" 
                                                     src="{{ asset('storage/app/public/' . $order->product->image) }}" 
                                                     alt="Image" 
                                                     style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>

                                    {{-- Use null coalescing operators for safety --}}
                                    <td>{{ ucfirst(optional($order->product)->name ?? 'N/A') }}</td>
                                    <td>{{ ucfirst($order->price ?? 'N/A') }}</td>
                                    <td>{{ ucfirst(optional($order->user)->name ?? 'N/A') }}</td>
                                    <td>{{ optional($order->user)->mobile ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($order->address ?? 'N/A') }}</td>
                                    <td>{{ $order->datetime ?? 'N/A' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pc-dt-simple').DataTable();
    });

    function confirmDelete(event, avatarId) {
        event.preventDefault();
        if (confirm("Are you sure you want to delete this avatar?")) {
            document.getElementById('delete-form-' + avatarId).submit();
        }
    }
</script>
@endsection
