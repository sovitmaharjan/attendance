@extends('layouts.app')
@section('shift_assignment', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Shift Assignment</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Shift Assignment</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                    </ul>
                    <li class="breadcrumb-item text-dark">Create</li>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <button type="button" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                            data-bs-toggle="modal" data-bs-target="#assign_off_day">
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
                            Assign off day
                        </button>
                    </div>
                    @can('add-shift-assignment')
                        <a href="{{ route('shift-assignment.index') }}" class="btn btn-sm btn-primary">Create</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="shift_assignment_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('shift-assignment.store') }}">
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
                                <div class="d-flex align-items-center gap-2 gap-lg-3 justify-content-end mb-10">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#assign_off_day">Assign off days
                                    </button>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Branch</label>
                                            <div class="d-flex">
                                                <select class="form-select branch-select" id="branch" name="branch"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Branch" required>
                                                    <option></option>
                                                    @foreach ($branch as $item)
                                                        <option value="{{ $item->id }}" @selected(old('branch') == $item->id)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Department</label>
                                            <div class="d-flex">
                                                <select class="form-select department-select" id="department"
                                                    name="department" data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Department">
                                                    <option></option>
                                                    @foreach ($department as $item)
                                                        <option value="{{ $item->id }}" @selected(old('department') == $item->id)>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Employee</label>
                                            <div class="d-flex">
                                                <select class="form-select employee-select" id="employee" name="employee"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Employee">
                                                    <option></option>
                                                    @foreach ($employee as $item)
                                                        <option value="{{ $item->id }}" @selected(old('employee') == $item->id)>
                                                            {{ $item->full_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Employee Id</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control employee_id" id="employee_id"
                                                    name="employee_id" value="{{ old('employee_id') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="py-5">
                                        <div class="rounded border p-5">
                                            <div id="shift_repeater">
                                                <div class="form-group">
                                                    <div data-repeater-list="shift_repeater">
                                                        @if (old('shift_repeater'))
                                                            @foreach (old('shift_repeater') as $key => $shift_repeater_value)
                                                                <div data-repeater-item="" id="init{{ $key }}">
                                                                    <div class="form-group row mb-5">
                                                                        <div class="col-md-3">
                                                                            <label
                                                                                class="required form-label">Shift</label>
                                                                            <div class="d-flex">
                                                                                <select class="form-select shift"
                                                                                    name="shift" data-control="select2"
                                                                                    data-hide-search="false"
                                                                                    data-placeholder="Select Shift">
                                                                                    <option></option>
                                                                                    @foreach ($shift as $item)
                                                                                        <option
                                                                                            value="{{ $item->id }}"
                                                                                            @selected($shift_repeater_value['shift'] == $item->id)>
                                                                                            {{ $item->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @error('shift_repeater.' . $key . '.shift')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-2 from">
                                                                            <label class="required form-label">From</label>
                                                                            <div class="d-flex">
                                                                                <input type="text"
                                                                                    class="form-control from_date"
                                                                                    placeholder="yyyy-dd-mm"
                                                                                    name="from_date" autocomplete="off"
                                                                                    value="{{ $shift_repeater_value['from_date'] }}" />
                                                                            </div>
                                                                            @error('shift_repeater.' . $key . '.from_date')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-2 nepali_from">
                                                                            <label class="form-label">&nbsp;</label>
                                                                            <div class="d-flex">
                                                                                <input type="text"
                                                                                    class="form-control nepali_from_date"
                                                                                    name="nepali_from_date"
                                                                                    autocomplete="off"
                                                                                    value="{{ $shift_repeater_value['nepali_from_date'] }}"
                                                                                    placeholder="yyyy-dd-mm">
                                                                            </div>
                                                                            @error('shift_repeater.' . $key .
                                                                                '.nepali_from_date')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-2 to">
                                                                            <label class="required form-label">To</label>
                                                                            <div class="d-flex">
                                                                                <input type="text" autocomplete="off"
                                                                                    class="form-control to_date"
                                                                                    placeholder="yyyy-dd-mm"
                                                                                    name="to_date"
                                                                                    value="{{ $shift_repeater_value['to_date'] }}" />
                                                                            </div>
                                                                            @error('shift_repeater.' . $key . '.to_date')
                                                                                <div
                                                                                    class="fv-plugins-message-container invalid-feedback">
                                                                                    <div data-field="name"
                                                                                        data-validator="notEmpty">
                                                                                        {{ $message }}
                                                                                    </div>
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-md-2 nepali_to">
                                                                            <label class="form-label">&nbsp;</label>
                                                                            <div class="d-flex">
                                                                                <input type="text" autocomplete="off"
                                                                                    class="form-control nepali_to_date"
                                                                                    name="nepali_to_date"
                                                                                    value="{{ $shift_repeater_value['nepali_to_date'] }}"
                                                                                    placeholder="yyyy-dd-mm">
                                                                            </div>
                                                                            @error('shift_repeater.' . $key .
                                                                                '.nepali_to_date')
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
                                                                    <div class="col-md-3">
                                                                        <label class="required form-label">Shift</label>
                                                                        <div class="d-flex">
                                                                            <select class="form-select shift"
                                                                                name="shift" data-control="select2"
                                                                                data-hide-search="false"
                                                                                data-placeholder="Select Shift">
                                                                                <option></option>
                                                                                @foreach ($shift as $item)
                                                                                    <option value="{{ $item->id }}">
                                                                                        {{ $item->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 from">
                                                                        <label class="required form-label">From</label>
                                                                        <div class="d-flex">
                                                                            <input type="text"
                                                                                class="form-control from_date"
                                                                                placeholder="yyyy-dd-mm" name="from_date"
                                                                                autocomplete="off"
                                                                                value="{{ old('from_date') }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 nepali_from">
                                                                        <label class="form-label">&nbsp;</label>
                                                                        <div class="d-flex">
                                                                            <input type="text"
                                                                                class="form-control nepali_from_date"
                                                                                name="nepali_from_date" autocomplete="off"
                                                                                value="{{ old('nepali_from_date') }}"
                                                                                placeholder="yyyy-dd-mm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 to">
                                                                        <label class="required form-label">To</label>
                                                                        <div class="d-flex">
                                                                            <input type="text" autocomplete="off"
                                                                                class="form-control to_date"
                                                                                value="{{ old('to_date') }}"
                                                                                placeholder="yyyy-dd-mm" name="to_date"
                                                                                value="{{ old('to_date') }}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2 nepali_to">
                                                                        <label class="form-label">&nbsp;</label>
                                                                        <div class="d-flex">
                                                                            <input type="text" autocomplete="off"
                                                                                class="form-control nepali_to_date"
                                                                                name="nepali_to_date"
                                                                                value="{{ old('nepali_to_date') }}"
                                                                                placeholder="yyyy-dd-mm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1">
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
                            <a href="{{ route('shift-assignment.index') }}" id="shift_assignment_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="shift_assignment_submit" class="btn btn-primary">
                                <span class="indicator-label">Save Changes</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="modal fade" id="assign_off_day" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content rounded">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                        rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <form id="assign_off_day_form" class="form" action="{{ route('assignOffDays') }}">
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Assign Off Days To <span id="departmentName"></span></h1>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <div class="d-flex flex-wrap gap-5">
                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="required form-label">Branch</label>
                                        <select class="form-select branch-select" id="branch" name="branch"
                                            data-control="select2" data-hide-search="false"
                                            data-placeholder="Select Branch" required>
                                            <option></option>
                                            @foreach ($branch as $item)
                                                <option value="{{ $item->id }}" @selected(old('branch') == $item->id)>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="required form-label">Department</label>
                                        <select class="form-select" id="department" name="department"
                                            data-control="select2" data-hide-search="false"
                                            data-placeholder="Select Department" required>
                                            <option></option>
                                            @foreach ($department as $item)
                                                <option value="{{ $item->id }}" @selected(old('department') == $item->id)>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="departmentId" name="department_id">
                                <input type="hidden" id="dynamicId" name="id">
                                <input type="hidden" name="key" id="keyname">
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Days</label>
                                    <div class="d-flex gap-5" id="daysSection">
                                        <select class="form-select" id="assignedDays" name="days[]"
                                            data-control="select2" data-hide-search="false"
                                            data-placeholder="Select Days" required multiple>
                                            <option></option>
                                            @foreach (getDays() as $day)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="reset" id="assign_off_day_cancel" class="btn btn-light me-3"
                                    data-bs-dismiss="modal">Cancel
                                </button>
                                <button type="button" id="assign_off_day_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endSection
@section('script')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $(document).on('select2:select', '.branch-select', function(e) {
            e.preventDefault();
            var studentSelect = $('#employee');
            var newOption = new Option('asdasd', 2222);
            studentSelect.append(newOption);
            // studentSelect.append('<option>asd</option>');

            // var id = $(this).val();
            // var url = "{{ route('ajax.branch.show', ':id') }}";
            // url = url.replace(':id', id);
            // $.ajax({
            //     method: 'GET',
            //     url: url,
            //     success: function (data) {
            //         console.log(data);
            //         $('.department-select').empty().trigger("change");
            //         $.each(data.departments, function(i, e) {
            //             var newOption = new Option(e.name, e.id);
            //             $('.department-select').append(newOption).trigger('change');
            //         });
            //         // $.each(data.employees, function(i, e) {
            //         //     employee += '<option value="' + e.id + '">' + e.name + '</option>'
            //         //     console.log(i, e);
            //         // });
            //         // $('.department-select').append(department);
            //     }
            // });
        });

        $(document).on('change', '#department', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('ajax.department.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    // console.log(data);
                }
            });
        });

        $('#employee').on('change', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('ajax.employee.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    $('#branch').val(data.branch_id).trigger('change');
                    $('#department').val(data.department_id).trigger('change');
                    $('#employee_id').val(data.id);
                }
            });
        });

        $('#shift_repeater').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function() {
                var div = $(this);

                div.slideDown();
                div.find('.shift').select2();

                div.find(".from_date").flatpickr({
                    onChange: function() {
                        div.find('input.nepali_from_date').val(NepaliFunctions.AD2BS(div.find(
                            '.from_date').val()));
                    }
                });
                div.find('.nepali_from_date').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function() {
                        div.find('.from_date').val(NepaliFunctions.BS2AD(div.find(
                            '.nepali_from_date').val()));
                    }
                });
                div.find(".to_date").flatpickr({
                    onChange: function() {
                        div.find('.nepali_to_date').val(NepaliFunctions.AD2BS(div.find(
                            '.to_date').val()));
                    }
                });
                div.find('.nepali_to_date').nepaliDatePicker({
                    ndpYear: true,
                    ndpMonth: true,
                    onChange: function() {
                        div.find('.to_date').val(NepaliFunctions.BS2AD(div.find(
                            '.nepali_to_date').val()));
                    }
                });
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function() {
                @if (old('shift_repeater'))
                    var shift_repeater = (@json(old('shift_repeater')));
                    $.each(shift_repeater, function(i, e) {
                        var div = $('#init' + i);

                        $('.shift').select2();

                        div.find(".from_date").flatpickr({
                            onChange: function() {
                                div.find('.nepali_from_date').val(NepaliFunctions.AD2BS(div.find(
                                        '.from_date')
                                    .val()));
                            }
                        });
                        div.find('.nepali_from_date').nepaliDatePicker({
                            ndpYear: true,
                            ndpMonth: true,
                            onChange: function() {
                                div.find('.from_date').val(NepaliFunctions.BS2AD(div.find(
                                        '.nepali_from_date')
                                    .val()));
                            }
                        });
                        div.find(".to_date").flatpickr({
                            onChange: function() {
                                div.find('.nepali_to_date').val(NepaliFunctions.AD2BS(div.find('.to_date')
                                    .val()));
                            }
                        });
                        div.find('.nepali_to_date').nepaliDatePicker({
                            ndpYear: true,
                            ndpMonth: true,
                            onChange: function() {
                                div.find('.to_date').val(NepaliFunctions.BS2AD(div.find('.nepali_to_date')
                                    .val()));
                            }
                        });
                    })
                @else
                    var div = $('#init');

                    $('.shift').select2();

                    div.find(".from_date").flatpickr({
                        onChange: function() {
                            div.find('.nepali_from_date').val(NepaliFunctions.AD2BS(div.find(
                                    '.from_date')
                                .val()));
                        }
                    });
                    div.find('.nepali_from_date').nepaliDatePicker({
                        ndpYear: true,
                        ndpMonth: true,
                        onChange: function() {
                            div.find('.from_date').val(NepaliFunctions.BS2AD(div.find(
                                    '.nepali_from_date')
                                .val()));
                        }
                    });
                    div.find(".to_date").flatpickr({
                        onChange: function() {
                            div.find('.nepali_to_date').val(NepaliFunctions.AD2BS(div.find('.to_date')
                                .val()));
                        }
                    });
                    div.find('.nepali_to_date').nepaliDatePicker({
                        ndpYear: true,
                        ndpMonth: true,
                        onChange: function() {
                            div.find('.to_date').val(NepaliFunctions.BS2AD(div.find('.nepali_to_date')
                                .val()));
                        }
                    });
                @endif
            }
        });
    </script>
@endsection
