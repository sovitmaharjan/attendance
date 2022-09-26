@extends('layouts.app')
@section('content')
    @php
        // dd($errors)
    @endphp
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Roster Assignment</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Roster Assignment</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('shift.index') }}"
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
                    <a href="{{ route('shift.create') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="shift_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('shift.store') }}" enctype="multipart/form-data">
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
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Branch</label>
                                            <select class="form-select mb-2" id="branch" name="branch"
                                                data-control="select2" data-hide-search="false"
                                                data-placeholder="Select Branch" required>
                                                <option></option>
                                                @foreach ($branch as $item)
                                                    <option value="{{ $item->id }}" @selected(old('branch') == $item->id)>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('branch')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    <div data-field="branch" data-validator="notEmpty">{{ $message }}
                                                    </div>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Department</label>
                                            <select class="form-select mb-2" id="department" name="department"
                                                data-control="select2" data-hide-search="false"
                                                data-placeholder="Select Department" required>
                                                <option></option>
                                                @foreach ($department as $item)
                                                    <option value="{{ $item->id }}" @selected(old('department') == $item->id)>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    <div data-field="department" data-validator="notEmpty">{{ $message }}
                                                    </div>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Employee</label>
                                            <select class="form-select mb-2" id="employee" name="employee"
                                                data-control="select2" data-hide-search="false"
                                                data-placeholder="Select Employee" required>
                                                <option></option>
                                                @foreach ($employee as $item)
                                                    <option value="{{ $item->id }}" @selected(old('employee') == $item->id)>
                                                        {{ $item->fullname }}</option>
                                                @endforeach
                                            </select>
                                            @error('employee')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    <div data-field="employee" data-validator="notEmpty">{{ $message }}
                                                    </div>
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Employee Id</label>
                                            <input type="text" class="form-control mb-2" id="employee_id"
                                                name="employee_id" value="{{ old('employee_id') }}" />
                                            @error('employee_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    <div data-field="employee_id" data-validator="notEmpty">
                                                        {{ $message }}
                                                    </div>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="py-5">
                                        <div class="rounded border p-5">
                                            <!--begin::Repeater-->
                                            <div id="kt_docs_repeater_basic">
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <div data-repeater-list="kt_docs_repeater_basic">
                                                        <div data-repeater-item="">
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-3">
                                                                    <label class="required form-label">Shift</label>
                                                                    <select class="form-select mb-2" id="shift"
                                                                        name="shift" data-control="select2"
                                                                        data-hide-search="false"
                                                                        data-placeholder="Select Shift" required>
                                                                        <option></option>
                                                                        @foreach ($shift as $item)
                                                                            <option value="{{ $item->name }}"
                                                                                @selected(old('shift') == $item->name)>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('shift')
                                                                        <div
                                                                            class="fv-plugins-message-container invalid-feedback">
                                                                            <div data-field="shift" data-validator="notEmpty">
                                                                                {{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="required form-label">From</label>
                                                                    <input type="text"
                                                                        class="form-control mb-2 from_date"
                                                                        onchange="engtonep($(this), 'nep_from_data')"
                                                                        value="{{ old('from_date') }}"
                                                                        placeholder="yyyy-dd-mm" id="from_date"
                                                                        name="from_date"
                                                                        value="{{ old('from_date') }}" />
                                                                    @error('from_date')
                                                                        <div
                                                                            class="fv-plugins-message-container invalid-feedback">
                                                                            <div data-field="from_date"
                                                                                data-validator="notEmpty">{{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                    <input type="text"
                                                                        class="form-control mb-2 nep_from_data"
                                                                        name="nepali_from_date"
                                                                        onclick="neptoeng('nep_from_data', 'from_date')"
                                                                        value="{{ old('nepali_from_date') }}"
                                                                        placeholder="yyyy-dd-mm" id="nep_from_data">
                                                                    @error('nepali_from_date')
                                                                        <div
                                                                            class="fv-plugins-message-container invalid-feedback">
                                                                            <div data-field="nepali_from_date"
                                                                                data-validator="notEmpty">{{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="required form-label">To</label>
                                                                    <input type="text"
                                                                        class="form-control mb-2 to_date"
                                                                        onchange="engtonep($(this), 'nep_to_date')"
                                                                        value="{{ old('from_date') }}"
                                                                        placeholder="yyyy-dd-mm" id="to_date"
                                                                        name="from_date"
                                                                        value="{{ old('from_date') }}" />
                                                                    @error('from_date')
                                                                        <div
                                                                            class="fv-plugins-message-container invalid-feedback">
                                                                            <div data-field="from_date"
                                                                                data-validator="notEmpty">{{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                    <input type="text"
                                                                        class="form-control mb-2 nep_to_date"
                                                                        name="nepali_from_date"
                                                                        onclick="neptoeng('nep_to_date', 'to_date')"
                                                                        value="{{ old('nepali_from_date') }}"
                                                                        placeholder="yyyy-dd-mm" id="nep_to_date">
                                                                    @error('nepali_from_date')
                                                                        <div
                                                                            class="fv-plugins-message-container invalid-feedback">
                                                                            <div data-field="nepali_from_date"
                                                                                data-validator="notEmpty">{{ $message }}
                                                                            </div>
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <a href="javascript:;" data-repeater-delete=""
                                                                        class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                                        <i class="la la-trash-o fs-3"></i>Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Form group-->
                                                <!--begin::Form group-->
                                                <div class="form-group">
                                                    <a href="javascript:;" data-repeater-create=""
                                                        class="btn btn-light-primary">
                                                        <i class="la la-plus"></i>Add</a>
                                                </div>
                                                <!--end::Form group-->
                                            </div>
                                            <!--end::Repeater-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('shift.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_shift_submit" class="btn btn-primary">
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
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $('.from_date, .to_date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            todayBtn: 'linked',
            clearBtn: true,
            autoclose: true,
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#branch', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.branch.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $(document).on('change', '#department', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.department.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                }
            });
        });

        $(document).on('change', '#employee', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.employee.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    // $('#branch').val(data.branch_id);
                    // $('#department').val(data.department_id);
                    $('#employee_id').val(data.id);
                }
            });
        });

        $('#kt_docs_repeater_basic').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    </script>
@endsection
