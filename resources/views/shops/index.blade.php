@extends('layouts.app2')
@section('content')
<div class="container" style="top: 5rem;">
  <div class="row d-flex justify-content-between">
    <h2 class="col-4">Shop List</h2>
    <form class="col-4" action="{{ route('shops.index') }}" method="GET">
      <div class="mb-4 input-group">
        <input type="text" name="search" class="form-control" placeholder="Search shops by name, alias, address, or status..." value="{{ request('search') }}" />
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>
    @if(Auth::user()->role == 'admin')
      <div class="col-4">
        <a href="{{ route('shops.create') }}" class="btn btn-primary w-100">Add Shop</a>
      </div>
    @endif
  </div>
  @if(Auth::user()->role == 'admin')
  <table class="table" style="margin-bottom: 5rem;">
      <tr>
          <th>Name</th>
          <th>Alias</th>
          <th>Owner Name</th>
          <th>Banner</th>
          <th>Actions</th>
      </tr>
      @foreach($shops as $shop)
      <tr>
          <td>{{ $shop->name }}</td>
          <td>{{ $shop->alise_name }}</td>
          <td>{{ $shop->owner?->name ?? 'No Owner Assigned' }}</td>
          <td><img src="data:image/png;base64,{{ $shop->details->banner_img }}" width="100" /></td>
          <td>
            <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-info">View Details</a>
            <a href="{{ route('shops.edit', $shop->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('shops.destroy', $shop->id) }}" method="POST" style="display:inline-block">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
      </tr>
      @endforeach
  </table>
  @endif
  @if(Auth::user()->role == 'owner')
  <div class="container" style="margin-bottom: 5rem;">

    @foreach($shops as $shop)
    <a href="{{ route('shops.show', $shop->id) }}" class="shop-link text-decoration-none">
        <div class="card mb-3 p-2 shadow-sm shop-card">
            <div class="d-flex align-items-center">
                <!-- Left Side: Shop Banner -->
                <div class="flex-shrink-0">
                    <img src="data:image/png;base64,{{ $shop->details->banner_img }}" alt="Shop Banner" class="rounded-start"
                        style="width: 80px; height: 80px; border-top-left-radius: 15px; border-bottom-left-radius: 15px;">
                </div>
    
                <!-- Right Side: Shop Details -->
                <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0 fw-bold text-dark">{{ $shop->name }}</h5>
                    <p class="text-muted mb-1">{{ $shop->alise_name }}</p>
                    <p class="text-muted small mb-0">{{ $shop->details->adress_line1 }}, {{ $shop->details->adress_line2 }}</p>
                </div>
    
                <!-- Bottom Right: Toggle Switch -->
                <div class="ms-auto d-flex align-items-center">
                    <label class="switch">
                        <input type="checkbox" class="toggle-status" data-shop-id="{{ $shop->id }}" {{ $shop->is_open ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                    <span class="badge ms-2 status-label {{ $shop->is_open ? 'bg-success' : 'bg-danger' }}">
                        {{ $shop->is_open ? 'Open' : 'Closed' }}
                    </span>
                </div>
            </div>
        </div>
    </a>
    @endforeach
  </div>
  @endif
</div>
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

  .switch {
      position: relative;
      display: inline-block;
      width: 34px;
      height: 20px;
  }

  .switch input {
      opacity: 0;
      width: 0;
      height: 0;
  }

  .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 20px;
  }

  .slider:before {
      position: absolute;
      content: "";
      height: 14px;
      width: 14px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
  }

  input:checked + .slider {
      background-color: #28a745;
  }

  input:checked + .slider:before {
      transform: translateX(14px);
  }
</style>

@include('layouts.partials.bottombar')
@endsection