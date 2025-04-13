@extends('layouts.app2')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg overflow-hidden">
        {{-- Shop Banner Image with Overlay --}}
        <div class="position-relative">
            <img src="{{ $shop->details->shop_img ? 'data:image/png;base64,' . $shop->details->shop_img : asset('assets/img/gallery/default_shop.png') }}" 
                 alt="Shop Banner" 
                 class="w-100" 
                 style="height: 300px; object-fit: cover;">
            <div class="position-absolute bottom-0 start-0 w-100 p-4 d-flex align-items-center justify-content-between flex-wrap"
                 style="background: rgba(0, 0, 0, 0.6); color: #fff;">
                <div>
                    <h2 class="m-0">{{ $shop->name }}</h2>
                    <p class="m-0">Owner Phone: {{ $shop->details->owner->mobile ?? 'N/A' }}</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ $shop->details->logo_img ? 'data:image/png;base64,' . $shop->details->logo_img : asset('assets/img/gallery/default_logo.png') }}" 
                         alt="Logo" class="rounded-circle border border-light" style="width: 80px; height: 80px; object-fit: cover;">
                    <img src="{{ $shop->details->banner_img ? 'data:image/png;base64,' . $shop->details->banner_img : asset('assets/img/gallery/default_banner.png') }}" 
                         alt="Shop Image" class="rounded border border-light" style="width: 120px; height: 80px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="row p-4 g-4">
            {{-- Left Column --}}
            <div class="col-md-6">
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
                    <p><strong>Name:</strong> {{ $shop->details->owner->name }}</p>
                    <p><strong>Email:</strong> {{ $shop->details->owner->email }}</p>
                    <p><strong>Phone:</strong> {{ $shop->details->owner->mobile }}</p>
                @else
                    <p class="text-danger">No owner assigned.</p>
                @endif
            </div>

            {{-- Right Column --}}
            <div class="col-md-6">
                <h4>Address</h4>
                <p>{{ $shop->details->adress_line1 }}</p>
                <p>{{ $shop->details->adress_line2 }}</p>

                <h4 class="mt-4">Working Hours</h4>
                <p><strong>Start Time:</strong> {{ $shop->details->start_time }}</p>
                <p><strong>End Time:</strong> {{ $shop->details->end_time }}</p>
            </div>
        </div>

        <div class="text-end p-4">
            <a href="{{ route('site') }}" class="btn btn-primary">Back to Shop List</a>
        </div>
    </div>
</div>
@endsection
