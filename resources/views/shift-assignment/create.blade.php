@extends('layouts.app')
@section('shift_assignment', 'active')
@section('content')
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
                    </ul>
                    <li class="breadcrumb-item text-dark">Create</li>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <button type="button" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder"
                                data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">
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
                        <a href="{{ route('shift-assignment.create') }}" class="btn btn-sm btn-primary">Create</a>
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
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span
                                            class="required"></span>
                                        are required </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 gap-lg-3 justify-content-end mb-10">
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_new_target">Assign off days
                                    </button>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Branch</label>
                                            <select class="form-select mb-2" id="branch" name="branch"
                                                    data-control="select2" data-hide-search="false"
                                                    data-placeholder="Select Branch" required>
                                                <option></option>
                                                @foreach ($branch as $item)
                                                    <option
                                                        value="{{ $item->id }}" @selected(old('branch') == $item->id)>
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
                                                    <option
                                                        value="{{ $item->id }}" @selected(old('department') == $item->id)>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                <div data-field="department" data-validator="notEmpty">
                                                    {{ $message }}
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
                                                    <option
                                                        value="{{ $item->id }}" @selected(old('employee') == $item->id)>
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
                                                   name="employee_id" value="{{ old('employee_id') }}"/>
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
                                            <div id="shift_repeater">
                                                <div class="form-group">
                                                    <div data-repeater-list="shift_repeater">
                                                        <div data-repeater-item="">
                                                            <div class="form-group row mb-5">
                                                                <div class="col-md-3">
                                                                    <label class="required form-label">Shift</label>
                                                                    <select class="form-select mb-2 shift" name="shift"
                                                                            data-control="select2"
                                                                            data-hide-search="false"
                                                                            data-placeholder="Select Shift" required>
                                                                        <option></option>
                                                                        @foreach ($shift as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                @selected(old('shift') == $item->name)>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('shift')
                                                                    <div
                                                                        class="fv-plugins-message-container invalid-feedback">
                                                                        <div data-field="shift"
                                                                             data-validator="notEmpty">
                                                                            {{ $message }}
                                                                        </div>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-2 from">
                                                                    <label class="required form-label">From</label>
                                                                    <input type="text"
                                                                           class="form-control mb-2 from_date"
                                                                           date-id="from"
                                                                           placeholder="yyyy-dd-mm" name="from_date"
                                                                           autocomplete="off"
                                                                           value="{{ old('from_date') }}"/>
                                                                    @error('from_date')
                                                                    <div
                                                                        class="fv-plugins-message-container invalid-feedback">
                                                                        <div data-field="from_date"
                                                                             data-validator="notEmpty">{{ $message }}
                                                                        </div>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-2 nep_from">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <input type="text"
                                                                           class="form-control mb-2 nep_from_date"
                                                                           name="nep_from_date" autocomplete="off"
                                                                           value="{{ old('nep_from_date') }}"
                                                                           placeholder="yyyy-dd-mm">
                                                                    @error('nep_from_date')
                                                                    <div
                                                                        class="fv-plugins-message-container invalid-feedback">
                                                                        <div data-field="nep_from_date"
                                                                             data-validator="notEmpty">{{ $message }}
                                                                        </div>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-2 to">
                                                                    <label class="required form-label">To</label>
                                                                    <input type="text" autocomplete="off"
                                                                           class="form-control mb-2 to_date"
                                                                           value="{{ old('to_date') }}" date-id="to"
                                                                           placeholder="yyyy-dd-mm" name="to_date"
                                                                           value="{{ old('to_date') }}"/>
                                                                    @error('to_date')
                                                                    <div
                                                                        class="fv-plugins-message-container invalid-feedback">
                                                                        <div data-field="to_date"
                                                                             data-validator="notEmpty">{{ $message }}
                                                                        </div>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-md-2 nep_to">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <input type="text" autocomplete="off"
                                                                           class="form-control mb-2 nep_to_date"
                                                                           name="nep_to_date"
                                                                           value="{{ old('nep_to_date') }}"
                                                                           placeholder="yyyy-dd-mm">
                                                                    @error('nep_to_date')
                                                                    <div
                                                                        class="fv-plugins-message-container invalid-feedback">
                                                                        <div data-field="nep_to_date"
                                                                             data-validator="notEmpty">{{ $message }}
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
                            <a href="{{ route('shift-assignment.create') }}" id="shift_assignment_cancel"
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
        <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content rounded">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                          rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="currentColor"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <form id="kt_modal_new_target_form" class="form" action="{{ route('assignOffDays') }}">
                            <div class="mb-13 text-center">
                                <h1 class="mb-3">Assign Off Days To <span id="departmentName"></span></h1>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                {{-- <div class="mb-10 fv-row"> --}}
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
                                                <option
                                                    value="{{ $item->id }}" @selected(old('department') == $item->id)>
                                                    {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="department" data-validator="notEmpty">
                                                {{ $message }}
                                            </div>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <input type="hidden" id="departmentId" name="department_id">
                                <input type="hidden" id="dynamicId" name="id">
                                <input type="hidden" name="key" id="keyname">
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Days</label>
                                    <div class="d-flex gap-5" id="daysSection">
                                        <select class="form-select mb-2" id="assignedDays" name="days[]"
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
                                <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                        data-bs-dismiss="modal">Cancel
                                </button>
                                <button type="button" id="kt_modal_new_target_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection
@section('script')
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('change', '#branch', function (e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.branch.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function (data) {
                    // myLog(data);
                    // data.departments.foreach()

                }
            });
        });

        $(document).on('change', '#department', function (e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.department.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function (data) {
                    // console.log(data);
                }
            });
        });

        $('#employee').on('change', function (e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.employee.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function (data) {
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

            show: function () {
                $(this).slideDown();
                $(this).find('.shift').select2();
                $(this).find('.from_date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    todayBtn: 'linked',
                    clearBtn: true,
                    autoclose: true,
                });
                $(this).find('.to_date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    todayBtn: 'linked',
                    clearBtn: true,
                    autoclose: true,
                });
                $(this).find('.nep_from_date').on('click', function () {
                    var a = $(this);
                    a.nepaliDatePicker({
                        language: "english",
                        onChange: function () {
                            var from = a.parent().prev('div').find('.from_date');
                            let nepalidate = a.val();
                            let dateObj = NepaliFunctions.ParseDate(nepalidate);
                            let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                            let year = engDate.year;
                            let month = NepaliFunctions.Get2DigitNo(engDate.month);
                            let day = NepaliFunctions.Get2DigitNo(engDate.day);
                            let engValue = year + '-' + month + '-' + day;
                            from.val(engValue);
                        },
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                });
                $(this).find('.nep_to_date').on('click', function () {
                    var a = $(this);
                    a.nepaliDatePicker({
                        language: "english",
                        onChange: function () {
                            var from = a.parent().prev('div').find('.to_date');
                            let nepalidate = a.val();
                            let dateObj = NepaliFunctions.ParseDate(nepalidate);
                            let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                            let year = engDate.year;
                            let month = NepaliFunctions.Get2DigitNo(engDate.month);
                            let day = NepaliFunctions.Get2DigitNo(engDate.day);
                            let engValue = year + '-' + month + '-' + day;
                            from.val(engValue);
                        },
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                });
                $(document).find('.from_date').on('change', function () {
                    var from = $(this).parent().next('div').find('.nep_from_date');
                    let dateObj = new Date($(this).val());
                    let year = dateObj.getUTCFullYear();
                    let month = dateObj.getUTCMonth() + 1;
                    let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
                    let nepaliDate = NepaliFunctions.AD2BS({
                        year: year,
                        month: month,
                        day: day
                    });
                    let nepaliYear = nepaliDate.year;
                    let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
                    let nepaliDay = ("0" + nepaliDate.day).slice(-2);
                    let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
                    from.val(nepaliValue);
                });
                $(this).find('.to_date').on('change', function () {
                    var to = $(this).parent().next('div').find('.nep_to_date');
                    let dateObj = new Date($(this).val());
                    let year = dateObj.getUTCFullYear();
                    let month = dateObj.getUTCMonth() + 1;
                    let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
                    let nepaliDate = NepaliFunctions.AD2BS({
                        year: year,
                        month: month,
                        day: day
                    });
                    let nepaliYear = nepaliDate.year;
                    let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
                    let nepaliDay = ("0" + nepaliDate.day).slice(-2);
                    let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
                    to.val(nepaliValue);
                });
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                $('.shift').select2();
                $('.from_date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    todayBtn: 'linked',
                    clearBtn: true,
                    autoclose: true,
                });
                $('.to_date').datepicker({
                    format: 'yyyy-mm-dd',
                    todayHighlight: true,
                    todayBtn: 'linked',
                    clearBtn: true,
                    autoclose: true,
                });
                $('.nep_from_date').on('click', function () {
                    var a = $(this);
                    a.nepaliDatePicker({
                        language: "english",
                        onChange: function () {
                            var from = a.parent().prev('div').find('.from_date');
                            let nepalidate = a.val();
                            let dateObj = NepaliFunctions.ParseDate(nepalidate);
                            let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                            let year = engDate.year;
                            let month = NepaliFunctions.Get2DigitNo(engDate.month);
                            let day = NepaliFunctions.Get2DigitNo(engDate.day);
                            let engValue = year + '-' + month + '-' + day;
                            from.val(engValue);
                        },
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                });
                $('.nep_to_date').on('click', function () {
                    var a = $(this);
                    a.nepaliDatePicker({
                        language: "english",
                        onChange: function () {
                            var from = a.parent().prev('div').find('.to_date');
                            let nepalidate = a.val();
                            let dateObj = NepaliFunctions.ParseDate(nepalidate);
                            let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                            let year = engDate.year;
                            let month = NepaliFunctions.Get2DigitNo(engDate.month);
                            let day = NepaliFunctions.Get2DigitNo(engDate.day);
                            let engValue = year + '-' + month + '-' + day;
                            from.val(engValue);
                        },
                        ndpYear: true,
                        ndpMonth: true,
                        ndpYearCount: 200
                    });
                });
            }
        });

        $('.from_date').on('change', function () {
            var from = $(this).parent().next('div').find('.nep_from_date');
            let dateObj = new Date($(this).val());
            let year = dateObj.getUTCFullYear();
            let month = dateObj.getUTCMonth() + 1;
            let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
            let nepaliDate = NepaliFunctions.AD2BS({
                year: year,
                month: month,
                day: day
            });
            let nepaliYear = nepaliDate.year;
            let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
            let nepaliDay = ("0" + nepaliDate.day).slice(-2);
            let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
            from.val(nepaliValue);
        });

        $('.to_date').on('change', function () {
            var to = $(this).parent().next('div').find('.nep_to_date');
            let dateObj = new Date($(this).val());
            let year = dateObj.getUTCFullYear();
            let month = dateObj.getUTCMonth() + 1;
            let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
            let nepaliDate = NepaliFunctions.AD2BS({
                year: year,
                month: month,
                day: day
            });
            let nepaliYear = nepaliDate.year;
            let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
            let nepaliDay = ("0" + nepaliDate.day).slice(-2);
            let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
            to.val(nepaliValue);
        });
    </script>
@endsection
