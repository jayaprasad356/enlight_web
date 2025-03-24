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
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Live Tracking') }}</th>
                                <th>{{ __('Datetime') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                   <td>{{ ucfirst($order->id) }}</td>
                                   <td>
                                            <a href="{{ asset('admin/storage/app/public/' . $order->products->image) }}" data-lightbox="image-{{ $order->id }}">
                                                <img class="customer-img img-thumbnail img-fluid" src="{{ asset('admin/storage/app/public/' . $order->products->image) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($order->products->name ?? '') }}</td>
                                        <td>{{ ucfirst($order->price) }}</td>
                                   <td>{{ ucfirst($order->users->name ?? '') }}</td>
                                   <td>{{ ucfirst($order->users->mobile ?? '') }}</td>
                                        <td>{{ ucfirst($order->address) }}</td>
                                        <td>
                                        @if($order->status == 0)
                                            <i class="fa fa-hourglass-start text-warning"></i> <span class="font-weight-bold">{{ __('Ordered') }}</span>
                                        @elseif($order->status == 1)
                                            <i class="fa fa-truck text-primary"></i> <span class="font-weight-bold">{{ __('Dispatched') }}</span>
                                        @elseif($order->status == 2)
                                            <i class="fa fa-box text-success"></i> <span class="font-weight-bold">{{ __('Delivered') }}</span>
                                        @elseif($order->status == 3)
                                            <i class="fa fa-ban text-danger"></i> <span class="font-weight-bold">{{ __('Cancelled') }}</span>
                                        @else
                                            <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold">{{ __('Unknown') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $order->live_tracking ? ucfirst($order->live_tracking) : __('Dispatch Pending') }}
                                   </td>
                                        <td>{{ ucfirst($order->datetime) }}</td>
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
        // Initialize DataTable with default search functionality
        $('#pc-dt-simple').DataTable();
    });

    // Confirmation for delete action
    function confirmDelete(event, avatarId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this avatar?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + avatarId).submit();
        }
    }
</script>
@endsection

