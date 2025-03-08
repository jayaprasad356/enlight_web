@extends('layouts.admin')

@section('page-title')
    {{ __('Help & Support List') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Help & Support List') }}</li>
@endsection

@section('content')
<div class="card">
    <div class="card-body text">
        <h5 class="card-title">{{ __('Help & Support') }}</h5>
        
        <br>
        
        <!-- Join Telegram Channel -->
        <a href="{{ $telegram_link }}" target="_blank" class="btn btn-info d-block w-50 mb-2">
            {{ __('Join Telegram Channel') }}
        </a>

        <!-- Zoho Chat Support -->
        <a href="{{ $zoho_chat_link }}" target="_blank" class="btn btn-success d-block w-50 mb-2">
            {{ __('Chat With Us') }}
        </a>

    </div>
</div>

<script>
    function copyInvitationLink() {
        // Create a temporary input field to copy the invitation link
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = "{{ $invitation_link }}"; // Add the invitation link
        tempInput.select();
        document.execCommand('copy'); // Copy the text to clipboard
        document.body.removeChild(tempInput);

        // Optional: Notify the user that the link has been copied
        alert("Invitation Link copied to clipboard!");
    }
</script>
@endsection
