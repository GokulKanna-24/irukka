{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@include('layouts.partials.header')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">
  @include('layouts.partials.topbar')
  @if(Auth::user()->role == 'user')
  <div class="container" style="top: 5rem; margin-bottom: 5rem;">
    <div class="row d-flex justify-content-between">
        <h2 class="mb-4 col-4">All Shops</h2>
        <form class="col-4" action="{{ route('dashboard') }}" method="GET">
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
                    <img src="data:image/png;base64,{{ $shop->details->banner_img }}" alt="Shop Banner" class="rounded-start"
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
  @endif
  @if(Auth::user()->role == 'owner')
  <div class="container" style="top: 5rem; margin-bottom: 5rem;">
    <div class="row d-flex justify-content-between">
        <h2 class="mb-4 col-4">Your Shop(s)</h2>
        <form class="col-4" action="{{ route('dashboard') }}" method="GET">
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
  {{-- @include('layouts.partials.main') --}}
  @include('layouts.partials.bottombar')

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
  
  
</main>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-status").forEach((toggle) => {
            toggle.addEventListener("change", function () {
                let shopId = this.getAttribute("data-shop-id");
                let isOpen = this.checked ? 1 : 0;

                fetch(`/shops/${shopId}/toggle-status`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({ is_open: isOpen }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let statusLabel = this.closest(".ms-auto").querySelector(".status-label");
                        statusLabel.textContent = isOpen ? "Open" : "Closed";
                        statusLabel.classList.toggle("bg-success", isOpen);
                        statusLabel.classList.toggle("bg-danger", !isOpen);
                    } else {
                        alert("Failed to update shop status");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@include('layouts.partials.footer')