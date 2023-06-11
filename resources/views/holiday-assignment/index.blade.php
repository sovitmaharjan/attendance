@extends('layouts.app')
@section('holiday_assignment', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Holiday Assignment</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Holiday Assignment</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    {{-- @can('view-holiday') --}}
                    <div class="m-0">
                        <a href="{{ route('holiday.index') }}"
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
                            Holiday List
                        </a>
                    </div>
                    {{-- @endcan --}}
                    {{-- @can('add-holiday-assignment') --}}
                    <a href="{{ route('holiday-assignment.index') }}" class="btn btn-sm btn-primary">Create</a>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="holiday_assignment_attendance" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('holiday-assignment.store') }}">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span class="required"></span>
                                        are required </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        @include('partials.dropdown-hierarchy.branch')
                                        @include('partials.dropdown-hierarchy.department')
                                        @include('partials.dropdown-hierarchy.reset')
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <button type="button" class="btn btn-sm btn-primary" id="load_employee_button">
                                        <span class="indicator-label">Load Employee(s)</span>
                                    </button>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="required form-label">Holiday</label>
                                        <div class="d-flex">
                                            <select class="form-select holiday" id="holiday" name="holiday"
                                                data-control="select2" data-hide-search="false"
                                                data-placeholder="Select Branch" required>
                                                <option></option>
                                                @foreach ($holiday as $item)
                                                    <option value="{{ $item->id }}" @selected(old('holiday', isset($dropdown['holiday_id']) ? $dropdown['holiday_id'] : '') == $item->id)>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <table id="holiday_table"
                                            class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                            <thead>
                                                <tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="w-75px">
                                                        <div
                                                            class="form-check form-check-custom form-check-solid form-check-inline">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="check-all" />
                                                        </div>
                                                    </th>
                                                    <th>Name</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                @if (isset($employee))
                                                    @foreach ($employee as $item)
                                                        <tr>
                                                            <td>
                                                                <div
                                                                    class="form-check form-check-custom form-check-solid form-check-inline">
                                                                    <input class="form-check-input employee-checkbox"
                                                                        type="checkbox" name="employee[]"
                                                                        value="{{ $item->id }}" />
                                                                </div>
                                                            </td>
                                                            <td>{{ $item->full_name }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('holiday-assignment.index') }}" id="holiday_assignment_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="holiday_assignment_submit" class="btn btn-primary">
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
@section('script')
    @include('partials.dropdown-hierarchy.script')
    <script>
        $(document).ready(function() {
            $('.department').prop('required', false);
        });

        $(document).on('click', '#check-all', function() {
            if ($(this).is(':checked')) {
                $('.employee-checkbox').prop('checked', true);
            } else {
                $('.employee-checkbox').prop('checked', false);
            }
        });

        $(document).on('click', '#load_employee_button', function() {
            var branchElem = $('#branch');

            $('.invalid-feedback').remove();
            !branchElem.val() ? message('branch').insertAfter(branchElem.parent()) : '';

            if (hierarchyEmployee.length > 0) {
                var html = '';
                hierarchyEmployee.forEach((e, i) => {
                    html += `<tr>
                        <td>
                            <div
                                class="form-check form-check-custom form-check-solid form-check-inline">
                                <input class="form-check-input employee-checkbox"
                                    type="checkbox" name="employee[]"
                                    value="${e.id}" />
                            </div>
                        </td>
                        <td>${e.full_name}</td>
                    </tr>`;
                });
                $('#tbody').html('');
                $('#tbody').html(html);
            } else {
                $('#check-all').prop('checked', false);
                $('#tbody').html('');
                toastr.error('Employee(s) not found');
            }
        });
    </script>
@endsection
