@extends('layouts.app')
@section('leave_balance', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Leave Balance</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Leave Balance</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('leave-balance.index') }}"
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
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="leave_balance_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('leave-balance.index') }}">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span class="required"></span>
                                        are required </span>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Leave</label>
                                            <div class="d-flex">
                                                <select class="form-select" id="leave_id" name="leave"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Branch" required>
                                                    <option></option>
                                                    @foreach ($leave as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ (isset($leave_id) && $leave_id == $item->id) || old('leave') == $item->id ? 'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        @include('partials.dropdown-hierarchy.branch')
                                        @include('partials.dropdown-hierarchy.department')
                                        @include('partials.dropdown-hierarchy.employee')
                                        @include('partials.dropdown-hierarchy.employee-id')
                                        @include('partials.dropdown-hierarchy.reset')
                                    </div>
                                </div>
                                <div class="mb-10 fv-row" style="float: right;">
                                    <a href="{{ route('leave-balance.index') }}" id="leave_balance_cancel"
                                        class="btn btn-light me-5">Cancel</a>
                                    <button type="submit" id="leave_balance_submit" class="btn btn-primary">
                                        <span class="indicator-label">Generate</span></span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span class="card-label fw-bolder fs-3 mb-1">Leave Balance List</span>
                                    </h3>
                                    <div class="pt-6">
                                        <div id="kt_customers_table_wrapper"
                                            class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="table-responsive">
                                                <table id="kt_datatable_example"
                                                    class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                                    <thead>
                                                        <tr
                                                            class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                                            <th>Total Leave Assign</th>
                                                            <th>Used</th>
                                                            <th>Available</th>
                                                            <th>Applied</th>
                                                            <th>Pending</th>
                                                            <th>Approved</th>
                                                            <th>Cancelled</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($result)
                                                            <tr>
                                                                <td>{{ $result['total_leave_assigned'] }} <br /> </td>
                                                                <td>{{ $result['used'] }} <br /> </td>
                                                                <td>{{ $result['available'] }} <br /> </td>
                                                                <td>{{ $result['applied'] }} <br /> </td>
                                                                <td>{{ $result['pending'] }} <br /> </td>
                                                                <td>{{ $result['approved'] }} <br /> </td>
                                                                <td>{{ $result['cancelled'] }} <br /> </td>
                                                            </tr>
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endSection
@section('script')
    @include('partials.dropdown-hierarchy.script')
    @include('partials.date-range.script')
@endSection
