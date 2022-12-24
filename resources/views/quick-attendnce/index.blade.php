@extends('layouts.app')
@section('holiday_type', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Quick Attendance</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Quick Attendance</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('quick-attendance') }}"
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
                    <a href="{{ route('quick-attendance') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Quick Attendance List</span>
                            {{-- <span class="text-muted mt-1 fw-bold fs-7">Manage you quick-attendance group </span> --}}
                        </h3>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                            title="">
                            <a href="{{ route('quick-attendance') }}" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_1">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                            rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor"></rect>
                                    </svg>
                                </span>
                                Add New
                            </a>
                        </div>

                        <div class="modal fade" tabindex="-1" id="kt_modal_1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form id="shift_form" class="form d-flex flex-column " method="POST"
                                        action="{{ route('quick-attendance') }}">
                                        <div class="modal-header">
                                            <div class="card-title">
                                                <span class="mt-1 fs-7 text-danger">Fields with asterisk<span
                                                        class="required"></span>
                                                    are required </span>
                                            </div>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-1"></span>
                                            </div>
                                        </div>

                                        <div class="modal-body">
                                            @csrf
                                            <div class="mb-10 fv-row">
                                                <div class="d-flex flex-wrap gap-5">
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="required form-label">Branch</label>
                                                        <select class="form-select mb-2" id="branch" name="branch"
                                                            data-control="select2" data-hide-search="false"
                                                            data-placeholder="Select Branch" required>
                                                            <option></option>
                                                            @foreach ($branch as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @selected(old('branch') == $item->id)>
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('branch')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="branch" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="required form-label">Department</label>
                                                        <select class="form-select mb-2" id="department"
                                                            name="department" data-control="select2"
                                                            data-hide-search="false" data-placeholder="Select Department"
                                                            required>
                                                            <option></option>
                                                            @foreach ($department as $item)
                                                                <option value="{{ $item->id }}"
                                                                    @selected(old('department') == $item->id)>
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
                                                                <option value="{{ $item->id }}"
                                                                    @selected(old('employee') == $item->id)>
                                                                    {{ $item->fullname }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('employee')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="employee" data-validator="notEmpty">
                                                                    {{ $message }}
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
                                                <div class="d-flex flex-wrap gap-5">
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="required form-label">From</label>
                                                        <input type="text" class="form-control mb-2 from_date"
                                                            date-id="from" placeholder="yyyy-dd-mm" name="from_date"
                                                            autocomplete="off" value="{{ old('from_date') }}" />
                                                        @error('from_date')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="from_date" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">&nbsp;</label>
                                                        <input type="text" class="form-control mb-2 nep_from_date"
                                                            name="nep_from_date" autocomplete="off"
                                                            value="{{ old('nep_from_date') }}" placeholder="yyyy-dd-mm">
                                                        @error('nep_from_date')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="nep_from_date" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="required form-label">To</label>
                                                        <input type="text" autocomplete="off"
                                                            class="form-control mb-2 to_date"
                                                            value="{{ old('to_date') }}" date-id="to"
                                                            placeholder="yyyy-dd-mm" name="to_date"
                                                            value="{{ old('to_date') }}" />
                                                        @error('to_date')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="to_date" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="fv-row w-100 flex-md-root">
                                                        <label class="form-label">&nbsp;</label>
                                                        <input type="text" autocomplete="off"
                                                            class="form-control mb-2 nep_to_date" name="nep_to_date"
                                                            value="{{ old('nep_to_date') }}" placeholder="yyyy-dd-mm">
                                                        @error('nep_to_date')
                                                            <div class="fv-plugins-message-container invalid-feedback">
                                                                <div data-field="nep_to_date" data-validator="notEmpty">
                                                                    {{ $message }}
                                                                </div>
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Generate</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body pt-0">
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id="kt_datatable_example_5"
                                    class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                    <thead>
                                        <tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>Shift</th>
                                            <th>In Time</th>
                                            <th>In Diff.</th>
                                            <th>In Remark</th>
                                            <th>Out Time</th>
                                            <th>Out Diff.</th>
                                            <th>Out Remark</th>
                                            <th>Worked Hour</th>
                                            <th>Mode</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @isset($report)
                                        @foreach ($report as $item)
                                            <tr>
                                                <td>{{ $item->date }} <br /> </td>
                                                <td>{{ $item->day }}</td>
                                                <td>{{ $item->shift_in_time }} <br/> {{ $item->shift_out_time }}</td>
                                                <td>{{ $item->in_time }}</td>
                                                <td>{{ $item->in_diff }}</td>
                                                <td>{{ $item->in_remark }}</td>
                                                <td>{{ $item->out_time }}</td>
                                                <td>{{ $item->out_diff }}</td>
                                                <td>{{ $item->out_remark }}</td>
                                                <td>{{ $item->work_hour }}</td>
                                                <td>N/A</td>
                                                <td></td>
                                            </tr>
                                        @endforeach
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
@endSection
@section('script')
<script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
<script>
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
                // myLog(data);
                // data.departments.foreach()

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
                // console.log(data);
            }
        });
    });

    $('#employee').on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();
        var url = "{{ route('api.employee.show', ':id') }}";
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

    $('.from_date').on('change', function() {
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

    $('.to_date').on('change', function() {
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
    </script>
@endSection