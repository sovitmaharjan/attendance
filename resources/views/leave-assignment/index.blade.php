@extends('layouts.app')
@section('leave_assignment', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Leave Assignment</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Leave Assignment</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @can('view-leave')
                        <div class="m-0">
                            <a href="{{ route('leave.index') }}"
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
                                Leave List
                            </a>
                        </div>
                    @endcan
                    @can('add-leave-assignment')
                        <a href="{{ route('leave-assignment.index') }}" class="btn btn-sm btn-primary">Create</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="leave_assignment_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('leave-assignment.store') }}">
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
                                    <div class="py-5">
                                        <div class="rounded border p-5">
                                            <div id="leave_repeater">
                                                <div class="form-group">
                                                    <div data-repeater-list="leave_repeater">
                                                        @if (old('leave_repeater'))
                                                            @foreach (old('leave_repeater') as $key => $leave_repeater_value)
                                                                <div data-repeater-item="">
                                                                    <div class="form-group row mb-5">
                                                                        <div class="col-md-4">
                                                                            <label class="required form-label">Leave</label>
                                                                            <div class="d-flex">
                                                                                <select class="form-select leave"
                                                                                    name="leave" data-control="select2"
                                                                                    data-hide-search="false"
                                                                                    data-placeholder="Select Leave"
                                                                                    required>
                                                                                    <option></option>
                                                                                    @foreach ($leave as $item)
                                                                                        <option value="{{ $item->id }}"
                                                                                            @selected($leave_repeater_value['leave'] == $item->id)>
                                                                                            {{ $item->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('leave_repeater.' . $key . '.leave')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="required form-label">Year</label>
                                                                            <div class="d-flex">
                                                                                <input type="number"
                                                                                    class="form-control year"
                                                                                    placeholder="yyyy" name="year"
                                                                                    value="{{ $leave_repeater_value['year'] }}"
                                                                                    required />
                                                                            </div>
                                                                            @error('leave_repeater.' . $key . '.year')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="required form-label">Allot
                                                                                day(s)</label>
                                                                            <div class="d-flex">
                                                                                <input type="number"
                                                                                    class="form-control allotted_days"
                                                                                    name="allotted_days" placeholder="00"
                                                                                    value="{{ $leave_repeater_value['allotted_days'] }}"
                                                                                    required />
                                                                            </div>
                                                                            @error('leave_repeater.' . $key .
                                                                                '.allotted_days')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <a href="javascript:;" data-repeater-delete=""
                                                                                class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                                                <i class="la la-trash-o fs-3"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <div data-repeater-item="" id="init">
                                                                <div class="form-group row mb-5">
                                                                    <div class="fv-row w-100 flex-md-root">
                                                                        <label class="required form-label">Leave</label>
                                                                        <div class="d-flex">
                                                                            <select class="form-select leave"
                                                                                name="leave" data-control="select2"
                                                                                data-hide-search="false"
                                                                                data-placeholder="Select Leave" required>
                                                                                <option></option>
                                                                                @foreach ($leave as $item)
                                                                                    <option value="{{ $item->id }}">
                                                                                        {{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row w-100 flex-md-root">
                                                                        <label class="required form-label">Allot
                                                                            day(s)</label>
                                                                        <div class="d-flex">
                                                                            <input type="number"
                                                                                class="form-control allotted_days"
                                                                                name="allotted_days" placeholder="00"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row w-100 flex-md-root">
                                                                        <label class="form-label" for="carryover_days">
                                                                            Carry Over Day(s)
                                                                            <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                                                data-bs-toggle="tooltip"
                                                                                aria-label="This represents the remaining leave day(s) from the previous years for the selected employee. Click here to add these days to the current year."
                                                                                data-bs-original-title="This represents the remaining leave day(s) from the previous years for the selected employee. Click here to add these days to the current year."
                                                                                data-kt-initialized="1"></i>
                                                                        </label>
                                                                        <div class="d-flex">
                                                                            <div
                                                                                class="form-check form-check-custom form-check-solid">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    name="carryover_days">
                                                                            </div>
                                                                            <input type="text"
                                                                                class="form-control previous_remaining_days mx-4"
                                                                                name="previous_remaining_days"
                                                                                placeholder="00" readonly />
                                                                        </div>
                                                                    </div>
                                                                    <div class="fv-row w-100 flex-md-root">
                                                                        <a href="javascript:;" data-repeater-delete=""
                                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                                            <i class="la la-trash-o fs-3"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <a href="javascript:;" data-repeater-create=""
                                                        class="btn btn-light-primary">
                                                        <i class="la la-plus"></i>Add</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('leave-assignment.index') }}" id="leave_assignment_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="leave_assignment_submit" class="btn btn-primary">
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
        // $('.employee').on('select2:select', function() {
        //     console.log('asdf');
        // });

        $('#leave_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                var div = $(this);

                div.slideDown();
                div.find('.leave').select2();

                div.find(".leave").on('select2:select', function() {
                    var leave_id = $(this).val();
                    var employee_id = $('#employee').val();
                    $.ajax({
                        method: 'POST',
                        url: "{{ route('ajax.get-leave-data') }}",
                        data: {
                            employee_id: employee_id,
                            leave_id: leave_id
                        },
                        success: function(response) {
                            response = response.data;
                            div.find($('.allotted_days')).val(response.leave
                                .allotted_days);
                            div.find($('.previous_remaining_days')).val(
                                response.previous_remaining_days);
                        }
                    });
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                @if (old('leave_repeater'))
                    var leave_repeater = (@json(old('leave_repeater')));
                    $.each(leave_repeater, function(i, e) {
                        var div = $('#init' + i);

                        $('.leave').select2();

                        div.find(".leave").on('select2:select', function() {
                            var leave_id = $(this).val();
                            var employee_id = $('#employee').val();
                            $.ajax({
                                method: 'POST',
                                url: "{{ route('ajax.get-leave-data') }}",
                                data: {
                                    employee_id: employee_id,
                                    leave_id: leave_id
                                },
                                success: function(response) {
                                    response = response.data;
                                    div.find($('.allotted_days')).val(response.leave
                                        .allotted_days);
                                    div.find($('.previous_remaining_days')).val(
                                        response.previous_remaining_days);
                                }
                            });
                        });
                    })
                @else
                    var div = $('#init');

                    $('.leave').select2();

                    div.find(".leave").on('select2:select', function() {
                        var leave_id = $(this).val();
                        var employee_id = $('#employee').val();
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('ajax.get-leave-data') }}",
                            data: {
                                employee_id: employee_id,
                                leave_id: leave_id
                            },
                            success: function(response) {
                                response = response.data;
                                div.find($('.allotted_days')).val(response.leave
                                    .allotted_days);
                                div.find($('.previous_remaining_days')).val(response
                                    .previous_remaining_days);
                            }
                        });
                    });
                @endif
            }
        });
    </script>
    @include('partials.dropdown-hierarchy.script')
@endsection
