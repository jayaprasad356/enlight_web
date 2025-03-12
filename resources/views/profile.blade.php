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
                                <th><i class="fas fa-qrcode text-primary"></i> {{ __('Refer Code') }}</th>
                                <td>{{ $user->refer_code }}</td>
                            </tr>

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

                    <!-- Buttons -->
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mt-3">
                        <i class="fas fa-arrow-left"></i> {{ __('Back to Dashboard') }}
                    </a>

                    <button class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#updateProfileModal">
                        <i class="fas fa-edit"></i> {{ __('Update Profile') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Updating Profile -->
    <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateProfileModalLabel">{{ __('Update Profile') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>{{ __('Name') }}</label>
                            <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>{{ __('Mobile') }}</label>
                            <input type="text" class="form-control" name="mobile" value="{{ $user->mobile }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>{{ __('Age') }}</label>
                            <input type="number" class="form-control" name="age" value="{{ $user->age }}" required>
                        </div>

                      
                        <div class="form-group mb-2">
                            <label>{{ __('Pincode') }}</label>
                            <input type="text" class="form-control" name="pincode" value="{{ $user->pincode }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>{{ __('Gender') }}</label>
                            <select class="form-control" name="gender" required>
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label>{{ __('Password') }}</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="password" value="{{ $user->password }}">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">{{ __('Leave blank to keep current password') }}</small>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save Changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include FontAwesome & Bootstrap JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelector('.toggle-password').addEventListener('click', function() {
            let passwordField = document.getElementById("password");
            let icon = this.querySelector("i");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    </script>
@endsection
