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
            <div class="card-body">
                <!-- Filter by Type Form -->
                <form action="{{ route('payment_screenshots.index') }}" method="GET" class="mb-3">
                    <div class="row align-items-end">
                        <!-- Existing Status Filter -->
                        <div class="col-md-3">
                            <label for="status">{{ __('Filter by Status') }}</label>
                            <select name="status" id="status" class="form-control status-filter" onchange="this.form.submit()">
                                <option value="">{{ __('All') }}</option>
                                <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>{{ __('Pending') }}</option>
                                <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>{{ __('Verified') }}</option>
                                <option value="2" {{ request()->get('status') == '2' ? 'selected' : '' }}>{{ __('Cancelled') }}</option>
                            </select>
                        </div>


                    </div>
                </form>

              
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                            <th>{{ __('Actions') }}</th>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('User Name') }}</th>
                                <th>{{ __('User Mobile') }}</th>
                                <th>{{ __('Screenshot') }}</th>
                                <th>{{ __('Status') }}</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment_screenshots as $payment_screenshot)
                                <tr>
                                <td class="Action">
                                        <span>
                                            <!-- Edit Button -->
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-url="{{ route('payment_screenshots.edit', $payment_screenshot->id) }}" 
                                                data-ajax-popup="true" data-title="{{ __('Edit Payment Screenshot') }}"
                                                class="btn btn-sm align-items-center" data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($payment_screenshot->id) }}</td>
                                    <td>{{ optional($payment_screenshot->users)->name ?? 'N/A' }}</td>
                                    <td>{{ optional($payment_screenshot->users)->mobile ?? 'N/A' }}</td>
                                    <td>
                                    @if($payment_screenshot->screenshots)
                                            <a href="{{ ('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots) }}" data-lightbox="image-{{ $payment_screenshot->id }}">
                                                <img class="user-img img-thumbnail img-fluid" 
                                                    src="{{('https://enlightapp.in/storage/app/public/' . $payment_screenshot->screenshots) }}" 
                                                    alt="Image" 
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        @else
                                            <img class="user-img img-thumbnail img-fluid" 
                                                src="{{ asset('storage/default.jpg') }}" 
                                                alt="Default Image" 
                                                style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td>
                                            @if($payment_screenshot->status == 0)
                                                <i class="fa fa-clock text-warning"></i> <span class="font-weight-bold">{{ __('Pending') }}</span>
                                            @elseif($payment_screenshot->status == 1)
                                                <i class="fa fa-check-circle text-success"></i> <span class="font-weight-bold">{{ __('Verified') }}</span>
                                            @elseif($payment_screenshot->status == 2)
                                                <i class="fa fa-times-circle text-danger"></i> <span class="font-weight-bold">{{ __('Cancelled') }}</span>
                                            @else
                                                <i class="fa fa-question-circle text-secondary"></i> <span class="font-weight-bold">{{ __('Unknown') }}</span>
                                            @endif
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
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
        <script>
         $(document).ready(function () {
    // Handle "Select All" checkbox
    $('#select-all').change(function() {
        // Get the state of the "Select All" checkbox
        var isChecked = $(this).prop('checked');

        // Select or deselect all individual checkboxes
        $('input[name="payment_screenshots_ids[]"]').prop('checked', isChecked);
    });

    // Handle individual checkboxes
    $('input[name="payment_screenshots_ids[]"]').change(function() {
        // If any individual checkbox is unchecked, uncheck the "Select All" checkbox
        if ($('input[name="payment_screenshots_ids[]"]:not(:checked)').length > 0) {
            $('#select-all').prop('checked', false); // Uncheck "Select All" checkbox
        } else {
            $('#select-all').prop('checked', true); // Check "Select All" checkbox if all are selected
        }
    });
});

        </script>

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