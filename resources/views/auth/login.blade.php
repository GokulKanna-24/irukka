{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@include('layouts.partials.header')
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main" id="top">

  <section class="overflow-hidden bg-primary" id="home" style="padding: unset; height: 100vh;">
		<div class="container">
			<div class="row flex-center">
				<div class="col-md-5 col-lg-6 order-0 order-md-1 mt-8 mt-md-0"><a class="img-landing-banner" href="{{ url('/') }}"><img class="img-fluid" src="assets/img/gallery/hero-header.png" alt="hero-header" /></a></div>
				<div class="col-md-7 col-lg-6 text-md-start text-center">
					<h1 class="display-1 fs-md-5 fs-lg-6 fs-xl-8 text-light">Are you starving?</h1>
					<h1 class="text-800 mb-5 fs-4">Within a few clicks, find meals that<br class="d-none d-xxl-block" />are accessible near you</h1>
					<div class="card w-xxl-75">
						<div class="card-body">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<button class="nav-link active mb-3" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fas fa-chalkboard-teacher me-2"></i>Login</button>
									<button class="nav-link mb-3" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-clipboard-list me-2"></i>Register</button>
								</div>
							</nav>
							<div class="tab-content mt-3" id="nav-tabContent">
								<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
									<!-- Session Status -->
									<x-auth-session-status class="mb-4" :status="session('status')" />

									<form class="row gx-2 gy-2 align-items-center" method="POST" action="{{ route('login') }}">
										@csrf

										
										<!-- Email Address -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-address-book text-danger input-box-icon"></i>
												<label class="visually-hidden" for="email">Email</label>
												<input class="form-control input-box form-foodwagon-control" id="email" type="email" 
													placeholder="Enter Your Email"
													name="email"
													:value="old('email')" required autofocus autocomplete="username"
												/>
											</div>
										</div>

										<!-- Password -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-fingerprint text-danger input-box-icon"></i>
												<label class="visually-hidden" for="password">Password</label>
												<input class="form-control input-box form-foodwagon-control" id="password" type="password" 
													placeholder="Enter Your Password"
													name="password"
													required autocomplete="current-password" 
												/>
											</div>
										</div>
										<div class="col">
											<x-input-error :messages="$errors->get('email')" class="mt-2" />
										</div>

										<!-- Remember Me -->
										<div class="block mt-4">
											<label for="remember_me" class="inline-flex items-center">
												<input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
												<span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
											</label>
										</div>

										<div class="col">
											@if (Route::has('password.request'))
												<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
														{{ __('Forgot your password?') }}
												</a>
											@endif
										</div>
										<div class="d-grid gap-3 col-sm-auto">
											<x-primary-button class="btn btn-danger ms-3">
												{{ __('Log in') }}
											</x-primary-button>
										</div>
									</form>
								</div>
								<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
									<form class="row gx-4 gy-2 align-items-center" method="POST" action="{{ route('register') }}">
										@csrf
									
										<!-- Name -->
										<div class="col-12">
											<div class="input-group-icon"><i class="fas fa-user-alt text-danger input-box-icon"></i>
												<label class="visually-hidden" for="name">Name</label>
												<input class="form-control input-box form-foodwagon-control" id="name" type="text" 
													placeholder="Enter Your Name"
													name="name"
													:value="old('name')" required autofocus autocomplete="name"
												/>
											</div>
											<x-input-error :messages="$errors->get('name')" class="mt-2" />
										</div>
									
										<!-- Email Address -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-address-book text-danger input-box-icon"></i>
												<label class="visually-hidden" for="email">Email</label>
												<input class="form-control input-box form-foodwagon-control" id="email" type="email" 
													placeholder="Enter Your email"
													name="email"
													:value="old('email')" required autocomplete="username"
												/>
											</div>
											<x-input-error :messages="$errors->get('email')" class="mt-2" />
										</div>

										<!-- Mobile Number -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-mobile-alt text-danger input-box-icon"></i>
												<label class="visually-hidden" for="mobile">Mobile Number</label>
												<input class="form-control input-box form-foodwagon-control" id="mobile" type="tel" 
													placeholder="Enter Your Mobile Number"
													name="mobile"
													:value="old('mobile')" required autocomplete="tel"
												/>
											</div>
											<x-input-error :messages="$errors->get('mobile')" class="mt-2" />
										</div>
									
									
										<!-- Password -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-fingerprint text-danger input-box-icon"></i>
												<label class="visually-hidden" for="password">Password</label>
												<input class="form-control input-box form-foodwagon-control" id="password" type="password" 
													placeholder="Enter Your Password"
													name="password"
													required autocomplete="new-password" 
												/>
											</div>
											<x-input-error :messages="$errors->get('password')" class="mt-2" />
										</div>
									
										<!-- Confirm Password -->
										<div class="col-6">
											<div class="input-group-icon"><i class="fas fa-low-vision text-danger input-box-icon"></i>
												<label class="visually-hidden" for="password_confirmation">Confirm Password</label>
												<input class="form-control input-box form-foodwagon-control" id="password_confirmation" type="password" 
													placeholder="Enter Your Confirm Password"
													name="password_confirmation"
													required autocomplete="new-password" 
												/>
											</div>
											<x-input-error :messages="$errors->get('password')" class="mt-2" />
										</div>

										<div class="col">
											<a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
												{{ __('Already registered?') }}
											</a>
										</div>
										<div class="d-grid gap-3 col-sm-auto">
											<x-primary-button class="btn btn-danger ms-4">
												{{ __('Register') }}
											</x-primary-button>
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
  
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->
@include('layouts.partials.footer')