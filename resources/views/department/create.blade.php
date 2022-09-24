@extends('layouts.app')
@section('role', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{$page}}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{$page}}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('branch.index') }}"
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
                    <a href="{{ route('branch.create') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="permission_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('branch.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="mt-1 fs-7">Fields with <span class="required"></span> are required
                                    </span>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div class="row">
                                    <x-form-inline-input label="Branch Name" name="name" placeholder="ABC Branch" type="text" info="Compay name must be unique" class="required form-label" col="6" />
                                    <x-form-inline-input label="Branch Code" name="code" placeholder="ABCC" type="text" info="Compay code must be unique" class="required form-label" col="6" />
                                </div>

                                <x-form-input label="Branch Email" class="required form-label" name="email" placeholder="Branch@mail.com" info="Must be a valid email" type="email" />

                                <div class="row">
                                    <x-form-inline-input class="required form-label" label="Branch Address" name="address" placeholder="ABC Branch" type="text" col="4" />
                                    <x-form-inline-input class="required form-label" label="Branch Phone Number" name="phone"  type="number" col="4" />
                                    <x-form-inline-input class="form-label" label="Branch Mobile Number" name="mobile"  type="number" col="4" />
                                </div>


                                <x-form-select class="required form-label" label="Parent Company"  name="company_id">
                                    @foreach($company as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </x-form-select>

                            </div>
                        </div>


                        <div class="d-flex justify-content-end">
                            <a href="{{ route('branch.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_permission_submit" class="btn btn-primary">
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
