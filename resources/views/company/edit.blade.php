@extends('layouts.app')
@section('company', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $page }}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $page }}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Edit</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @can('view-company')
                        <div class="m-0">
                            <a href="{{ route('company.index') }}"
                               class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder">
                            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="black"></path>
                                    <path opacity="0.3"
                                          d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                          fill="black"></path>
                                </svg>
                            </span>
                                List
                            </a>
                        </div>
                    @endcan
                    {{-- <a href="{{ route('company.update', $data->id) }}" class="btn btn-sm btn-primary">Edit this</a> --}}
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="company_form" class="form d-flex flex-column flex-lg-row" method="POST"
                      action="{{ route('company.update', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="mt-1 fs-7">Fields with <span class="required"></span> are required
                                    </span>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Name</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="name"
                                                       value="{{ $data->name }}"/>
                                            </div>
                                            @error('name')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="name" data-validator="notEmpty">
                                                    {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Code</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="code"
                                                       value="{{ $data->code }}"/>
                                            </div>
                                            @error('code')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="code" data-validator="notEmpty">
                                                    {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Email</label>
                                            <input type="text" class="form-control mb-2" name="email"
                                                   value="{{ $data->email }}"/>
                                            <div class="text-muted fs-7">Must be a valid email</div>
                                        </div>
                                        @error('email')
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="email" data-validator="notEmpty">
                                                {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Address</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="address"
                                                       value="{{ $data->address }}"/>
                                            </div>
                                            @error('address')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="address" data-validator="notEmpty">
                                                    {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Phone Number</label>
                                            <div class="d-flex">
                                                <input type="number" min="1" class="form-control mb-2"
                                                       name="phone" value="{{ $data->phone }}"/>
                                            </div>
                                            @error('phone')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="phone" data-validator="notEmpty">
                                                    {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Mobile Number</label>
                                            <div class="d-flex">
                                                <input type="number" min="1" class="form-control mb-2"
                                                       name="mobile" value="{{ $data->mobile }}"/>
                                            </div>
                                            @error('mobile')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="mobile" data-validator="notEmpty">
                                                    {{ $message }}</div>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Company Website</label>
                                            <input type="text" class="form-control mb-2" name="website"
                                                   value="{{ $data->website }}"/>
                                        </div>

                                        @error('website')
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="website" data-validator="notEmpty">
                                                {{ $message }}</div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <a href="{{ route('company.index') }}" id="company_cancel"
                               class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="company_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endSection
