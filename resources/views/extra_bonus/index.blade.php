@extends('layouts.admin')

@section('title', 'Extra Bonus Management')
@section('content-header', 'Extra Bonus Management')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Extra Bonus Levels</h3>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive"> <!-- Makes the table scrollable on small screens -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Required Refers</th>
                        <th>Refers Done</th>
                        <th>Bonus Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $levels = [
                            ['level' => 1, 'refers' => 10, 'bonus' => 1000],
                            ['level' => 2, 'refers' => 30, 'bonus' => 2000],
                            ['level' => 3, 'refers' => 90, 'bonus' => 3000],
                            ['level' => 4, 'refers' => 270, 'bonus' => 5000],
                        ];
                    @endphp
                    @foreach($levels as $level)
                        @php
                            $levelNumber = $level['level'];
                            $userReferrals = $referralCounts[$levelNumber] ?? 0;
                            $isEligible = $userReferrals >= $level['refers'];
                        @endphp
                        <tr>
                            <td>Level {{ $level['level'] }}</td>
                            <td>{{ $level['refers'] }} Refers</td>
                            <td>{{ $userReferrals }} Referrals</td>
                            <td>₹{{ number_format($level['bonus']) }}</td>
                            <td>
                                <form action="{{ route('bonus.claim', $level['level']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success" 
                                        {{ $isEligible ? '' : 'disabled' }}>
                                        Claim
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> <!-- End .table-responsive -->
    </div>
</div>
@endsection
