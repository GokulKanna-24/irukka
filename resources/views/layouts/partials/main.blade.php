<section class="py-5 overflow-hidden bg-primary" id="home">
  <div class="container">
    <div class="row flex-center">
      <div class="col-md-5 col-lg-6 order-0 order-md-1 mt-8 mt-md-0"><a class="img-landing-banner" href="#!"><img class="img-fluid" src="assets/img/gallery/hero-header.png" alt="hero-header" /></a></div>
      <div class="col-md-7 col-lg-6 py-8 text-md-start text-center">
        <h1 class="display-1 fs-md-5 fs-lg-6 fs-xl-8 text-light">Are you starving?</h1>
        <h1 class="text-800 mb-5 fs-4">Within a few clicks, find meals that<br class="d-none d-xxl-block" />are accessible near you</h1>
        <div class="card w-xxl-75">
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane fade show active">
                <form class="row gx-2 gy-2 align-items-center" action="{{ route('site') }}" method="GET">
                  <div class="col">
                    <div class="input-group-icon"><i class="fas fa-search text-danger input-box-icon"></i>
                      <label class="visually-hidden" for="search">Search</label>
                      <input class="form-control input-box form-foodwagon-control" id="search" name="search" type="text" placeholder="Search Shop"  value="{{ request('search') }}" />
                    </div>
                  </div>
                  <div class="d-grid gap-3 col-sm-auto">
                    <button class="btn btn-danger" type="submit">Find</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section id="testimonial">
  <div class="container">
    <div class="row h-100">
      <div class="col-lg-7 mx-auto text-center mb-6">
        <h5 class="fw-bold fs-3 fs-lg-5 lh-sm mb-3">Available shops here!</h5>
      </div>
    </div>
    <div class="row gx-2" id="shop-list">

      {{-- @foreach($shops as $shop)
      <div class="col-sm-6 col-md-4 col-lg-3 h-100 mb-5">
        <div class="card card-span h-100 text-white rounded-3"><img class="img-fluid rounded-3 h-100" src="data:image/png;base64,{{ $shop->details->banner_img }}" alt="..." />
          <div class="card-img-overlay ps-0">
            <span class="badge bg-danger p-2 ms-3">
              <i class="fas fa-tag me-2 fs-0"></i>
              <span class="fs-0">20% off</span>
            </span>
            <span class="badge bg-primary ms-2 me-1 p-2">
              <i class="fas fa-clock me-1 fs-0"></i>
              <span class="fs-0">Fast</span>
            </span>
          </div>
          <div class="card-body ps-0">
            <div class="d-flex align-items-center mb-3"><img class="img-fluid" src="data:image/png;base64,{{ $shop->details->logo_img }}" alt="" />
              <div class="flex-1 ms-3">
                <h5 class="mb-0 fw-bold text-1000">{{ $shop->name }}</h5>
                <span class="text-primary fs--1 me-1"><i class="fas fa-star"></i></span>
                <span class="mb-0 text-primary">{{ $shop->alise_name }}</span>
              </div>
            </div>
            @if ($shop->is_open)
              <span class="badge bg-soft-success p-2"><span class="fw-bold fs-1 text-success">Open Now</span></span>
            @else
              <span class="badge bg-soft-danger p-2"><span class="fw-bold fs-1 text-danger">Opens Tomorrow</span></span>
            @endif
            
          </div>
        </div>
      </div>
      @endforeach --}}

      @foreach($shops as $shop)
      <a href="{{ route('shops.show', $shop->id) }}"  class="col-sm-6 col-md-4 col-lg-3 h-100 mb-5">
        <div class="card shop-card h-100 rounded-3">
            <!-- Shop Banner Image -->
            <div class="banner-container">
                <img class="img-fluid shop-banner" src="data:image/png;base64,{{ $shop->details->banner_img }}" alt="Shop Banner" />
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <!-- Logo -->
                    <img class="shop-logo" src="data:image/png;base64,{{ $shop->details->logo_img }}" alt="Shop Logo" />

                    <!-- Shop Info -->
                    <div class="ms-3">
                        <h5 class="mb-0 fw-bold text-dark">{{ $shop->name }}</h5>
                        <span class="text-primary fs--1 me-1"><i class="fas fa-star"></i></span>
                        <span class="mb-0 text-primary">{{ $shop->alise_name }}</span>
                        {{-- <p class="text-muted small mb-1">{{ $shop->alise_name }}</p> --}}
                    </div>
                </div>

                <!-- Shop Status -->
                <div class="shop-status">
                    @if ($shop->is_open)
                      <span class="badge bg-soft-success p-2"><span class="fw-bold fs-1 text-success">Open Now</span></span>
                    @else
                      <span class="badge bg-soft-danger p-2"><span class="fw-bold fs-1 text-danger">Opens Tomorrow</span></span>
                    @endif
                </div>
                
            </div>
        </div>
      </a>
      @endforeach
      <!-- Hover Effect Styles -->
      <style>
        .shop-card {
            transition: 0.3s ease-in-out;
            overflow: hidden;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Banner Image - Auto Scales to Fit Design */
        .banner-container {
            width: 100%;
            height: 120px; /* Fixed height */
            overflow: hidden;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .shop-banner {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Maintains design ratio without stretching */
            border-radius: 15px 15px 0 0;
        }

        /* Logo Styling */
        .shop-logo {
            width: 40px;
            height: 40px;
            border-radius: 20%;
            object-fit: cover; /* Prevents distortion */
            border: 2px solid #fff;
        }

        /* Hover Effect */
        .shop-card:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .shop-card:hover .shop-banner {
            border-radius: 0;
        }

        /* Shop Status */
        .shop-status {
            margin-top: 10px;
            text-align: left;
        }
      </style>

      <div class="col-12 d-flex justify-content-center mt-5"> <a class="btn btn-lg btn-primary" href="{{ route('shops.list') }}">View All <i class="fas fa-chevron-right ms-2"> </i></a></div> 
    </div>
  </div>
</section>

<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="py-0 bg-primary-gradient">

  <div class="container">
    <div class="row justify-content-center g-0">
      <div class="col-xl-9">
        <div class="col-lg-6 text-center mx-auto mb-3 mb-md-5 mt-4">
          <h5 class="fw-bold text-danger fs-3 fs-lg-5 lh-sm my-6">How does it work</h5>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-3 mb-6">
            <div class="text-center"><img class="shadow-icon" src="assets/img/gallery/location.png" height="112" alt="..." />
              <h5 class="mt-4 fw-bold">Select location</h5>
              <p class="mb-md-0">Choose the location where your food will be delivered.</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-6">
            <div class="text-center"><img class="shadow-icon" src="assets/img/gallery/order.png" height="112" alt="..." />
              <h5 class="mt-4 fw-bold">Choose order</h5>
              <p class="mb-md-0">Check over hundreds of menus to pick your favorite food</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-6">
            <div class="text-center"><img class="shadow-icon" src="assets/img/gallery/pay.png" height="112" alt="..." />
              <h5 class="mt-4 fw-bold">Pay advanced</h5>
              <p class="mb-md-0">It's quick, safe, and simple. Select several methods of payment</p>
            </div>
          </div>
          <div class="col-sm-6 col-md-3 mb-6">
            <div class="text-center"><img class="shadow-icon" src="assets/img/gallery/meals.png" height="112" alt="..." />
              <h5 class="mt-4 fw-bold">Enjoy meals</h5>
              <p class="mb-md-0">Food is made and delivered directly to your home.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->