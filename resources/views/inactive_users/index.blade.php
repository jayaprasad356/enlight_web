@extends('layouts.admin')

@section('page-title')
    {{ __('My Inactive Customers List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('My Inactive Customers List') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <!-- Row to align buttons on the left and balance on the right -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <!-- Buttons (Left Aligned) -->
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="btn btn-info recharge-now-btn" onclick="showImage()">
                            {{ __('Recharge Now') }}
                        </button>

                        <button type="button" class="btn btn-warning upload-screenshot-btn" 
                            onclick="window.location.href='{{ route('payment_screenshots.create') }}'">
                            {{ __('Upload Screenshot') }}
                        </button>
                    </div>

                    <!-- Balance (Right Aligned) -->
                    <div class="recharge-balance p-2" style="font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
                        <strong>{{ __('My Refer Code :') }} {{ $refer_code }}</strong>
                    </div>
                    <div class="recharge-balance p-2" style="font-size: 16px; background-color: #f1f1f1; padding: 5px 10px; border-radius: 5px;">
                        <strong>{{ __('Membership Activation Balance: Rs') }} {{ $recharge }}</strong>
                    </div>
                </div>

                <br>
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Mobile') }}</th>
                                <th>{{ __('DateTime') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['name'] ?? 'N/A' }}</td>
                                    <td>{{ $user['mobile'] ?? 'N/A' }}</td>
                                    <td>{{ $user['registered_datetime'] ?? 'N/A' }}</td>
                                    <td>
                                        <!-- Button to trigger modal -->
                                        <button type="button" class="btn btn-success btn-sm activate-user-btn" 
                                            data-id="{{ $user['id'] }}" 
                                            data-name="{{ $user['name'] ?? 'N/A' }}" 
                                            data-mobile="{{ $user['mobile'] ?? 'N/A' }}">
                                            {{ __('Click To Activate') }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Bootstrap Modal -->
                <div class="modal fade" id="userActivationModal" tabindex="-1" aria-labelledby="userActivationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userActivationModalLabel">{{ __('Customer Details') }}</h5>
                                <!-- Button to close modal -->
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>{{ __('Customer ID:') }}</strong> <span id="modalUserId"></span> | <strong>{{ __('Name:') }}</strong> <span id="modalUserName"></span> | <strong>{{ __('Mobile:') }}</strong> <span id="modalUserMobile"></span></p>

                                <!-- Level-specific activation buttons -->
                                <div class="mt-3">
                                    <center><button type="button" class="btn btn-primary w-50 mb-2" id="level1Btn">{{ __('Level 1') }}</button></center>
                                    <center><button type="button" class="btn btn-secondary w-50 mb-2" id="level2Btn">{{ __('Level 2') }}</button></center>
                                    <center><button type="button" class="btn btn-warning w-50 mb-2" id="level3Btn">{{ __('Level 3') }}</button></center>
                                    <center><button type="button" class="btn btn-danger w-50 mb-2" id="level4Btn">{{ __('Level 4') }}</button></center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4>{{ __('Customers List') }}</h4>
                <form method="GET" action="{{ route('inactive_users.index') }}" class="d-flex justify-content-end mb-3">
                        <input type="text" id="customerSearch" name="mobile" value="{{ request('mobile') }}" 
                            placeholder="Search by mobile number" class="form-control me-2" style="width: 200px;">
                        <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                    </form>
                    <br>
                <div class="table-responsive">
                <table class="table" id="customers-table">
                    <thead>
                        <tr>
                            <th>{{ __('ID') }}</th>
                            <th>{{ __('Customer Name') }}</th>
                            <th>{{ __('Mobile') }}</th>
                            <th>{{ __('DateTime') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($customers->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">No customers found.</td>
                            </tr>
                        @else
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer['id'] }}</td>
                                    <td>{{ $customer['name'] ?? 'N/A' }}</td>
                                    <td>{{ $customer['mobile'] ?? 'N/A' }}</td>
                                    <td>{{ $customer['registered_datetime'] ?? 'N/A' }}</td>
                                    <td>
                                        @if(isset($customer['status']) && $customer['status'] == 0)
                                            <!-- Show "Click To Activate" button only if status is 0 -->
                                            <button type="button" class="btn btn-success btn-sm activate-user-btn" 
                                                data-id="{{ $customer['id'] }}" 
                                                data-name="{{ $customer['name'] ?? 'N/A' }}" 
                                                data-mobile="{{ $customer['mobile'] ?? 'N/A' }}">
                                                {{ __('Click To enable') }}
                                            </button>
                                        @else
                                            <span class="badge bg-secondary">{{ __('Already Activated') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

                </div>

            </div>
        </div>
    </div>
</div>




<div id="qrCodeModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Scan QR Code for Subscription') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                    @if(isset($news) && $news->qr_image)
                        <img id="qrImage" src="{{ asset('admin/storage/app/public/' . $news->qr_image) }}" alt="QR Code" class="img-fluid" />
                    @else
                        <p>{{ __('No QR code available') }}</p>
                    @endif

                <p class="mt-3">{{ __('Scan this QR code to complete your subscription.') }}</p>
            </div>
        </div>
@endsection



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->

<script>
  $(document).ready(function () {
    // When "Activate User" button is clicked
    $(".activate-user-btn").on("click", function () {
        let userId = $(this).data("id");
        let userName = $(this).data("name");
        let userMobile = $(this).data("mobile");
        let buttonText = $(this).text().trim();

        // Update modal content with the selected user's info
        $("#modalUserId").text(userId);
        $("#modalUserName").text(userName);
        $("#modalUserMobile").text(userMobile);

        // Set data attributes for level-specific buttons
        $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").each(function (index, btn) {
            $(btn).data("userId", userId)
                .data("userName", userName)
                .data("userMobile", userMobile)
                .data("level", index + 1);
        });

        // Enable all level buttons if "Click To Activate" is clicked
        if (buttonText === "Click To Activate") {
            $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").prop("disabled", false);
        }
        // Disable Level 2, 3, and 4 if "Click To Enable" is clicked
        else if (buttonText === "Click To enable") {
            $("#level2Btn, #level3Btn, #level4Btn").prop("disabled", true);
            $("#level1Btn").prop("disabled", false);
        }

        // Open the modal
        $("#userActivationModal").modal("show");
    });

    // Handle level-specific activation buttons
    $("#level1Btn, #level2Btn, #level3Btn, #level4Btn").on("click", function () {
        let userId = $(this).data("userId");
        let userName = $(this).data("userName");
        let userMobile = $(this).data("userMobile");
        let level = $(this).data("level");

        // Redirect to activation route
        window.location.href = "{{ route('inactive_users.activate') }}" +
            "?id=" + userId +
            "&name=" + userName +
            "&mobile=" + userMobile +
            "&level=" + level;
    });
});


</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

<script>
function showImage() {
    // Open the modal
    $('#qrCodeModal').modal('show');
    
}

$(document).ready(function() {
    // Close the modal when clicking the close button
    $('.close').click(function() {
        $('#qrCodeModal').modal('hide');
    });

    // Also close when clicking outside the modal content
    $(document).click(function(event) {
        if ($(event.target).closest("#qrCodeModal .modal-content").length === 0) {
            $('#qrCodeModal').modal('hide');
        }
    });
});
</script>
<script>
$(document).ready(function () {
    $("#customerSearch").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        $("#customers-table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});
</script>
