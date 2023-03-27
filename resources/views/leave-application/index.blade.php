@extends('layouts.app')
@section('leave_application', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Leave Application</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Leave Application</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('leave-application.index') }}"
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
                    <a href="{{ route('leave-application.index') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="leave_application_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('leave-application.store') }}">
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
                                        @include('partials.dropdown-hierarchy.employee')
                                        @include('partials.dropdown-hierarchy.employee-id')
                                        @include('partials.dropdown-hierarchy.reset')
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Leave</label>
                                            <div class="d-flex">
                                                <select class="form-select" id="leave" name="leave"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Branch" required>
                                                    <option></option>
                                                    @foreach ($leave as $item)
                                                        <option value="{{ $item->id }}" @selected(old('leave'))>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">From</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control from_date" date-id="from"
                                                    placeholder="yyyy-dd-mm" id="from_date" name="from_date"
                                                    autocomplete="off"
                                                    value="{{ old('from_date') }}"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control nepali_from_date"
                                                    id="nepali_from_date" name="nepali_from_date" autocomplete="off"
                                                    value="{{ old('nepali_from_date') }}"
                                                    placeholder="yyyy-dd-mm" required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">To</label>
                                            <div class="d-flex">
                                                <input type="text" autocomplete="off" class="form-control to_date"
                                                    value="{{ old('to_date') }}"
                                                    date-id="to" placeholder="yyyy-dd-mm" id="to_date" name="to_date"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex">
                                                <input type="text" autocomplete="off"
                                                    class="form-control nepali_to_date" id="nepali_to_date"
                                                    name="nepali_to_date"
                                                    value="{{ old('nepali_to_date') }}"
                                                    placeholder="yyyy-dd-mm" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Leave Reason</label>
                                            <textarea name="description" class="form-control mb-2" id="description" rows="3" required>{{ old('description') }}</textarea>
                                            <div class="text-muted fs-7">Leave reason</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div id="kt_customers_table_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <style>
                                            .border-color {
                                                border-color: #d7d7d7 !important;
                                            }

                                            .border-right {
                                                border-right: solid #d7d7d7 1px !important;
                                            }

                                            .mxtb {
                                                margin-top: -10px;
                                                margin-bottom: -10px;
                                            }
                                        </style>
                                        <div class="table-responsive">
                                            <table id="kt_datatable_example_5"
                                                class="table table-row-bordered table-rounded gy-5 gs-7 border align-middle border-color">
                                                <thead>
                                                    <tr
                                                        class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0 border-color">
                                                        <th class="border-right" width="15%">Total Leave Assigned</th>
                                                        <th class="border-right" width="15%">Available</th>
                                                        <th class="border-right" width="15%">Used</th>
                                                        <th class="border-right" width="15%">Pending</th>
                                                        <th class="border-right" width="15%">Approved</th>
                                                        <th width="15%">Applied</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border-right">12</td>
                                                        <td class="border-right">10</td>
                                                        <td class="border-right">1</td>
                                                        <td class="border-right">0</td>
                                                        <td class="border-right">1</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('leave-application.index') }}" id="leave_application_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="leave_application_submit" class="btn btn-primary">
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
        $('.employee_id').on('keyup', delay(function() {
            getLeaveData();
        }, 700));
        $('#leave').on('select2:select', function() {
            getLeaveData();
        });
        function getLeaveData() {
            var employee_id = $('#employee').val();
            var leave_id = $('#leave').val();
            var url = "{{ route('ajax.get-leave-data') }}";
            console.log('asdasd');
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    employee_id: employee_id,
                    leave_id: leave_id
                },
                success: function(response) {
                    // $('.allotted_days')
                }
            });
        }
    </script>
    @include('partials.date-range.script')
@endSection
