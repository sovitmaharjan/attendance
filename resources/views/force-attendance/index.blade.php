@extends('layouts.app')
@section('force_attendance', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Force Attendance</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Force Attendance</li>
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
                            Shift List
                        </a>
                    </div>
                    <a href="{{ route('shift-assignment.index') }}" class="btn btn-sm btn-primary">Shift Assignment</a>
                    <a href="{{ route('force-attendance.index') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="force-attendance_attendance" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('force-attendance.store') }}">
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
                                @include('partials.date-range.html')
                                <div class="mb-10 fv-row">
                                    <button type="button" class="btn btn-sm btn-primary" id="button">
                                        <span class="indicator-label">Load Shift(s)</span>
                                    </button>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
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
                                                        <th class="border-right w-100px">Date</th>
                                                        <th class="border-right w-100px">Shift</th>
                                                        <th class="border-right w-100px">In Time</th>
                                                        <th class="w-100px">Out Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('force-attendance.index') }}" id="force_attendance_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="force_attendance_submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
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
        englishToNepaliDatePicker($('.from_date'), $('.nepali_from_date'));
        nepaliToEnglishDatepicker($('.nepali_from_date'), $('.from_date'));
        englishToNepaliDatePicker($('.to_date'), $('.nepali_to_date'));
        nepaliToEnglishDatepicker($('.nepali_to_date'), $('.to_date'));

        $(document).on('change', '#branch, #department, #employee', function() {
            $('#tbody').html('');
        });
        $(document).on('keup', '#employee_id', delay(function() {
            $('#tbody').html('');
        }, 500));

        $('#button').on('click', function() {
            var branchElem = $('#branch');
            var departmentElem = $('#department');
            var employeeElem = $('#employee');
            var employeeIdElem = $('#employee_id');
            var fromDateElem = $('#from_date');
            var nepaliFromDateElem = $('#nepali_from_date');
            var toDateElem = $('#to_date');
            var nepalitoDateElem = $('#nepali_to_date');

            function message(field) {
                return $(
                    '<div class="fv-plugins-message-container invalid-feedback"><div data-fiedivld="name"-validator="notEmpty">The ' +
                    field + ' feild is required</div></div>');
            }

            $('.invalid-feedback').remove();
            !branchElem.val() ? message('branch').insertAfter(branchElem.parent()) : '';
            !departmentElem.val() ? message('department').insertAfter(departmentElem.parent()) : '';
            !employeeElem.val() ? message('employee').insertAfter(employeeElem.parent()) : '';
            !employeeIdElem.val() ? message('employee id').insertAfter(employeeIdElem.parent()) : '';
            !fromDateElem.val() ? message('from date').insertAfter(fromDateElem.parent()) : '';
            !nepaliFromDateElem.val() ? message('nepali from date').insertAfter(nepaliFromDateElem.parent()) : '';
            !toDateElem.val() ? message('to date').insertAfter(toDateElem.parent()) : '';
            !nepalitoDateElem.val() ? message('nepali to date').insertAfter(nepalitoDateElem.parent()) : '';

            if (!branchElem.val() || !departmentElem.val() || !employeeElem.val() || !employeeIdElem.val() || !
                fromDateElem.val() || !nepaliFromDateElem.val() || !toDateElem.val() || !nepalitoDateElem.val()) {
                return;
            }

            if (fromDateElem.val() > toDateElem.val()) {
                $('<div class="fv-plugins-message-container invalid-feedback"><div data-fiedivld="name"-validator="notEmpty">The to date must be a date after or equal to from date.</div></div>').insertAfter(toDateElem.parent());
                return;
            }

            const date1 = $("#from_date").val();
            const date2 = $("#to_date").val();
            var url = "{{ route('ajax.get-employee-shift') }}";
            data = {
                'employee_id': $('#employee_id').val(),
                'from_date': date1,
                'to_date': date2
            };
            $.ajax({
                method: 'GET',
                url: url,
                data: data,
                success: function(data) {
                    console.log(data);
                    if (data.length == 0) {
                        toastr.error(
                            'For shift assignment: <a href="{{ route('shift-assignment.index') }}"><button type="button" class="btn btn-light btn-sm">click here</button></a>',
                            'No Shift assigned to the employee on the selected date(s).');
                    } else {
                        var html = '';
                        data.forEach((e, i) => {
                            html += '<tr class="border-color">' +
                                '<td class="border-right">' +
                                e.date + '<br />' + NepaliFunctions.AD2BS(e.date) +
                                '<input type="hidden" class="form-control border-0 mxtb" name="force_attendance[' +
                                i + '][date]" value="' + e.date + '" />' +
                                '</td>' +
                                '<td class="border-right">' +
                                e.shift.name + '<br />(' + e.shift.in_time + '-' + e.shift
                                .out_time + ')' +
                                '<input type="hidden" class="form-control border-0 mxtb" name="force_attendance[' +
                                i + '][shift]" value="' + e.shift.id + '" />' +
                                '</td>' +
                                '<td class="border-right">' +
                                '<input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[' +
                                i + '][in_time]" value="' + e.in_time + '" />' +
                                '</td>' +
                                '<td>' +
                                '<input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[' +
                                i + '][out_time]" value="' + e.out_time + '" />' +
                                '</td>' +
                                '</tr>';
                        });
                        $('#tbody').html('');
                        $('#tbody').html(html);
                        $(".timepicker").flatpickr({
                            enableTime: true,
                            noCalendar: true,
                            dateFormat: "H:i",
                        });
                        $('.justify-content-end').prop('hidden', false);
                    }
                }
            });
        });
    </script>
    @include('partials.dropdown-hierarchy.script')
    @if ($errors->has('force_attendance') && $errors->count() == 1)
        <script>
            toastr.error(
                'Possible reasons:<br/><ul><li>Load button was not clicked(maybe).</li><li>Missing input data</li><li>No Shift assigned to the employee on the selected date(s). For shift assignment: <a href="{{ route('shift-assignment.index') }}"><button type="button" class="btn btn-light btn-sm">click here</button></a></li><li>Employee does not exist</li></ul>',
                'Force Attendance data(list) is missing.');
        </script>
    @endif
@endsection
