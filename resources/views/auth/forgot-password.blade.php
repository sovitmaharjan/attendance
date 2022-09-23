@extends('auth.layouts.app')

@section('content')
<form class="form w-100" novalidate="novalidate" id="" method="post" action="{{ route('reset-password-mail') }}">
    @csrf
    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">Forgot Password ?</h1>
        <div class="text-gray-400 fw-bold fs-4">Enter your email to reset your password.</div>
    </div>
    <div class="fv-row mb-10">
        <label class="form-label fw-bolder text-gray-900 fs-6">Email</label>
        <input class="form-control form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
    </div>
    <div class="d-flex flex-wrap justify-content-center pb-lg-0">
        <button type="submit" id="" class="btn btn-lg btn-primary fw-bolder me-4">
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait...
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        <a href="{{ route('login') }}" class="btn btn-lg btn-light-primary fw-bolder">Cancel</a>
    </div>
</form>
@endsection

@section('script')
    @error('email')
    <script>
        toastr.error('{{ $message }}');
    </script>
    @enderror
@endsection