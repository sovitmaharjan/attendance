@extends('layouts.app')
@section('permission', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Permission</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Permission</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @can('view-permission')
                        <div class="m-0">
                            <a href="{{ route('permission.index') }}"
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
                    @can('add-permission')
                        <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary">Create</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="permission_form" class="form d-flex flex-column flex-lg-row" method="POST"
                      action="{{ route('permission.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span
                                            class="required"></span>
                                        are required </span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Permission Name</label>
                                    <input type="text" name="name" class="form-control mb-2"
                                           placeholder="Permission name" value="{{ old('name') }}" required/>
                                    <div class="text-muted fs-7">A permission name is required and recommended to be
                                        unique.
                                    </div>
                                    @error('name')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="name" data-validator="notEmpty">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Permission Group</label>
                                    <select class="form-select mb-2" data-control="select2" name="permission_group_id"
                                            data-hide-search="true" data-placeholder="Select an option" required>
                                        <option></option>
                                        @foreach ($permission_group as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('permission_group_id')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="permission_group_id" data-validator="notEmpty">{{ $message }}
                                        </div>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('permission.index') }}" id="permission_cancel"
                               class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="permission_submit" class="btn btn-primary">
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
