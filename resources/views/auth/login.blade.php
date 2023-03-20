@extends('auth.layouts.app')

@section('content')
    <form class="form w-100" novalidate="novalidate" id="" method="post" action="{{ route('login') }}">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark mb-3">Sign In</h1>
        </div>
        <div class="fv-row mb-10">
            <label class="form-label fs-6 fw-bolder text-dark">User Id</label>
            <input class="form-control form-control-lg form-control-solid" type="text" name="login_id" autocomplete="off" value="{{ old('login_id') }}" />
            @error('login_id')
                <div class="fv-plugins-message-container invalid-feedback">
                    <div data-field="id" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <div class="fv-row mb-10">
            <div class="d-flex flex-stack mb-2">
                <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                <a href="{{ route('forgot-password') }}" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
            </div>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password" id="password" autocomplete="off" value="{{ old('password') }}" />
            @error('password')
                <div class="fv-plugins-message-container invalid-feedback">
                    <div data-field="password" data-validator="notEmpty">{{ $message }}</div>
                </div>
            @enderror
        </div>
        <div class="text-center">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">Continue</span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            {{-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div>
            <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="assets/media/svg/brand-logos/google-icon.svg" class="h-20px me-3" />Continue with Google</a> --}}
            {{-- <a href="#" class="btn btn-flex flex-center btn-light btn-lg w-100 mb-5">
            <img alt="Logo" src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-3" />Continue with Facebook</a> --}}
        </div>
    </form>
@endsection

@section('script')
	<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    @error('login_id')
    <script>
        toastr.error('', '{{ $message }}');
    </script>
    @enderror
    @error('password')
    <script>
        toastr.error('', '{{ $message }}');
    </script>
    @enderror
@endsection