@extends('layouts.app2')

@section('content')
<div class="container" style="top: 5rem; margin-bottom: 5rem;">
    <h2 class="mb-4">{{ $shop->name }} - Details</h2>

    <div class="card p-4">
        <h4>Basic Information</h4>
        <p><strong>Name:</strong> {{ $shop->name }}</p>
        <p><strong>Alias Name:</strong> {{ $shop->alise_name }}</p>
        <p><strong>Status:</strong> 
            @if ($shop->is_open)
                <span class="badge bg-success">Open</span>
            @else
                <span class="badge bg-danger">Closed</span>
            @endif
        </p>

        <h4 class="mt-4">Owner Information</h4>
        @if ($shop->details->owner)
            <p><strong>Owner Name:</strong> {{ $shop->details->owner->name }}</p>
            <p><strong>Email:</strong> {{ $shop->details->owner->email }}</p>
            <p><strong>Phone:</strong> {{ $shop->details->owner->mobile }}</p>
        @else
            <p class="text-danger">No owner assigned.</p>
        @endif

        <h4 class="mt-4">Shop Images</h4>
        <div class="d-flex">
            <img src="data:image/png;base64,{{ $shop->details->banner_img }}" class="img-fluid me-2" width="200" />
            <img src="data:image/png;base64,{{ $shop->details->logo_img }}" class="img-fluid me-2" width="100" />
            <img src="data:image/png;base64,{{ $shop->details->shop_img }}" class="img-fluid" width="200" />
        </div>

        <h4 class="mt-4">Address</h4>
        <p>{{ $shop->details->adress_line1 }}</p>
        <p>{{ $shop->details->adress_line2 }}</p>

        <h4 class="mt-4">Working Hours</h4>
        <p><strong>Start Time:</strong> {{ $shop->details->start_time }}</p>
        <p><strong>End Time:</strong> {{ $shop->details->end_time }}</p>

        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Back to Shop List</a>
    </div>
</div>
@endsection