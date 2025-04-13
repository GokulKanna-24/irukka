@extends('layouts.app2')

@section('content')
<div class="container" style="top: 5rem; margin-bottom: 5rem;">
    <div class="row d-flex justify-content-between">
        <h2 class="mb-4 col-4">All Shops</h2>
        <form class="col-4" action="{{ route('shops.list') }}" method="GET">
          <div class="mb-4 input-group">
            <input type="text" name="search" class="form-control" placeholder="Search shops by name, alias, address, or status..." value="{{ request('search') }}" />
            <button class="btn btn-primary" type="submit">Search</button>
          </div>
        </form>
      </div>

    @foreach($shops as $shop)
    <a href="{{ route('shops.show', $shop->id) }}" class="shop-link text-decoration-none">
        <div class="card mb-3 p-2 shadow-sm shop-card">
            <div class="d-flex align-items-center">
                <!-- Left Side: Shop Banner -->
                <div class="flex-shrink-0">
                    <img src="{{ $shop->details->banner_img ? 'data:image/png;base64,' . $shop->details->banner_img : asset('assets/img/gallery/default_banner.png') }}"
                        alt="Shop Banner" class="rounded-start"
                        style="width: 80px; height: 80px; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                </div>

                <!-- Right Side: Shop Details -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0 fw-bold text-dark">{{ $shop->name }}</h5>
                    <p class="text-muted mb-1">{{ $shop->alise_name }}</p>
                    <p class="text-muted small mb-0">{{ $shop->details->adress_line1 }}, {{ $shop->details->adress_line2 }}</p>
                </div>

                <!-- Bottom Right: Status -->
                <div class="ms-auto">
                    @if ($shop->is_open)
                        <span class="badge bg-success">Open</span>
                    @else
                        <span class="badge bg-danger">Closed</span>
                    @endif
                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>

<!-- Hover Effect Styles -->
<style>
    .shop-card {
        transition: 0.3s ease-in-out;
    }
    .shop-card:hover {
        background-color: #f8f9fa; /* Light Gray */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .shop-link {
        cursor: pointer;
    }
</style>
@endsection