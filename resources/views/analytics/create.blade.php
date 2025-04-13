@extends('layouts.app')

@section('content')
<div class="container">

    <div class="mb-4 text-center">
        <label for="range" class="form-label">Select Date Range</label>
        <input type="text" class="form-control d-inline w-auto" id="range" value="7/10/22 - 7/11/22" readonly>
    </div>

    <form action="{{ route('analytics.store') }}" method="POST">
        @csrf

        @php
        $metrics = [
        'Google Analytics' => 'google_analytics',
        'Microsoft Clarity' => 'microsoft_clarity',
        'Facebook' => 'facebook',
        'Instagram' => 'instagram',
        'Snapchat' => 'snapchat',
        ];
        @endphp

        @foreach($metrics as $label => $field)
        <div class="row align-items-end mb-3" data-metric="{{ $field }}">
            <div class="col-md-3">
                <input type="text" name="{{ $field }}_data" placeholder="{{$field}}" class="form-control metric-data">
            </div>
            <div class="col-md-2">
                <input type="date" name="{{ $field }}_date" class="form-control metric-date">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100 send-btn" data-field="{{ $field }}">OK</button>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-dark w-100">Current Total</button>
            </div>
        </div>

        @endforeach

    </form>
</div>
<script>
$(document).ready(function() {
    $('.send-btn').click(function() {
        let field = $(this).data('field');
        let row = $(this).closest('.row');
        let data = row.find('.metric-data').val();
        let date = row.find('.metric-date').val();

        if (!data || !date) {
            alert('Please enter both data and date.');
            return;
        }

        $.ajax({
            url: "{{ route('analytics.store') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                action: field + "_ok",
                [field + '_data']: data,
                [field + '_date']: date
            },
            success: function(res) {
                alert("Saved successfully!");
                row.find('.metric-data').val('');
                row.find('.metric-date').val('');
            },
            error: function(xhr) {
                alert("Error: " + xhr.responseJSON.message ?? 'Something went wrong.');
            }
        });
    });
});
</script>

@endsection