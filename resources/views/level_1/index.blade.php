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
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Customer Name') }}</th>
                                <th>{{ __('Mobile') }}</th>
                                <th>{{ __('Level 1 Refer') }}</th>
                                <th>{{ __('Level 2 Refer') }}</th>
                                <th>{{ __('Level 3 Refer') }}</th>
                                <th>{{ __('Level 4 Refer') }}</th>
                                <th>{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id'] }}</td>
                                    <td>{{ $user['name'] ?? 'N/A' }}</td>
                                    <td>{{ $user['mobile'] ?? 'N/A' }}</td>
                                    <td>{{ $user['level_1_referrer_name'] ?? 'N/A' }}</td>
                                    <td>{{ $user['level_2_referrer_name'] ?? 'N/A' }}</td>
                                    <td>{{ $user['level_3_referrer_name'] ?? 'N/A' }}</td>
                                    <td>{{ $user['level_4_referrer_name'] ?? 'N/A' }}</td>
                                    <td>
                                        <button class="btn btn-primary view-details" 
                                            data-id="{{ $user['id'] }}" 
                                            data-name="{{ $user['name'] }}" 
                                            data-mobile="{{ $user['mobile'] }}">
                                            View
                                        </button>
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

<!-- Modal -->
<div class="modal fade" id="userDetailModal" tabindex="-1" role="dialog" aria-labelledby="userDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDetailModalLabel">User Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Customer Name:</strong> <span id="modalCustomerName"></span></p>
                <p><strong>Mobile:</strong> <span id="modalCustomerMobile"></span></p>
                <p><strong>Level 1 Count:</strong> <span id="level1Count">0</span></p>
                <p><strong>Level 2 Count:</strong> <span id="level2Count">0</span></p>
                <p><strong>Level 3 Count:</strong> <span id="level3Count">0</span></p>
                <p><strong>Level 4 Count:</strong> <span id="level4Count">0</span></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Ensure jQuery is loaded -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->

<script>
    $(document).ready(function() {
        $('.view-details').on('click', function() {
            let userId = $(this).data('id');
            let userName = $(this).data('name');
            let userMobile = $(this).data('mobile');

            // Set modal values
            $('#modalCustomerName').text(userName);
            $('#modalCustomerMobile').text(userMobile);

            // Fetch referral counts via AJAX
            $.ajax({
                url: "{{ route('getUserReferrals') }}",
                type: "GET",
                data: { user_id: userId },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        $('#level1Count').text(response.level_1_count || 0);
                        $('#level2Count').text(response.level_2_count || 0);
                        $('#level3Count').text(response.level_3_count || 0);
                        $('#level4Count').text(response.level_4_count || 0);
                    } else {
                        $('#level1Count').text("N/A");
                        $('#level2Count').text("N/A");
                        $('#level3Count').text("N/A");
                        $('#level4Count').text("N/A");
                    }
                    $('#userDetailModal').modal('show'); // Open modal
                },
                error: function() {
                    alert('Error fetching data.');
                }
            });
        });

        // Close modal when clicking the close (×) button
        $('.close').on('click', function() {
            $('#userDetailModal').modal('hide');
        });

        // Close modal when clicking outside of it
        $(document).on('click', function(event) {
            if ($(event.target).closest('.modal-content').length === 0) {
                $('#userDetailModal').modal('hide');
            }
        });
    });
</script>
@endsection
