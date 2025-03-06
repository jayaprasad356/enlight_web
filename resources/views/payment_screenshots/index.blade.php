@extends('layouts.admin')

@section('page-title')
    {{ __('Manage Payment Screenshot') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Payment Screenshot') }}</li>
@endsection


@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Payment Screenshot List') }}</h5>
            </div>
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Screenshot') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment_screenshots as $payment_screenshot)
                                <tr>
                                   <td>{{ ucfirst($payment_screenshot->id) }}</td>
                                    <td>
                                        <a href="{{ asset('storage/app/public/' . $payment_screenshot->screenshots) }}" data-lightbox="image-{{ $payment_screenshot->id }}">
                                            <img class="customer-img img-thumbnail img-fluid" src="{{ asset('storage/app/public/' . $payment_screenshot->screenshots) }}" alt="Image" style="max-width: 100px; max-height: 100px;">
                                        </a>
                                    </td>
                                    
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
    function confirmDelete(event, giftId) {
        event.preventDefault(); // Prevent the default form submission

        // Show a confirmation dialog
        if (confirm("Are you sure you want to delete this Payment Screenshot?")) {
            // If the user clicks "Yes", submit the delete form
            document.getElementById('delete-form-' + giftId).submit();
        }
    }
</script>
@endsection

