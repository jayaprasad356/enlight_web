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
        <button onclick="loadZohoChat()" class="btn btn-success d-block w-50 mb-2">
            {{ __('Chat With Us') }}
        </button>

    </div>
</div>

<script>
    function loadZohoChat() {
        if (!document.getElementById('zsiqscript')) {
            window.$zoho = window.$zoho || {};
            $zoho.salesiq = $zoho.salesiq || {ready: function(){}};

            let script = document.createElement('script');
            script.id = "zsiqscript";
            script.src = "https://salesiq.zohopublic.in/widget?wc=siqb9948ef51cb6689eed89e1c5a558a1a4cc64b9992892718da9c37636c8a62250";
            script.defer = true;
            document.body.appendChild(script);
        }
        document.head.appendChild(style);
    }
</script>

@endsection
