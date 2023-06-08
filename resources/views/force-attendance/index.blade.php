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
                        <a href="{{ route('work-hour.index') }}"
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
                            Work Hour List
                        </a>
                    </div>
                    <a href="{{ route('work-hour-assignment.create') }}" class="btn btn-sm btn-primary">Work Hour
                        Assignment</a>
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
                                    <button type="button" class="btn btn-sm btn-primary" id="load_attendance_button">
                                        <span class="indicator-label">Load Work Hour(s)</span>
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
                                            <table id="attendance_table"
                                                class="table table-row-bordered table-rounded gy-5 gs-7 border align-middle border-color">
                                                <thead>
                                                    <tr
                                                        class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0 border-color">
                                                        <th class="border-right w-100px">Assigned Date</th>
                                                        <th class="border-right w-100px">Work Hour</th>
                                                        <th class="border-right w-100px">Shift</th>
                                                        <th class="border-right w-50px"></th>
                                                        <th class="border-right w-100px">In Date</th>
                                                        <th class="border-right w-100px">In Time</th>
                                                        <th class="border-right w-100px">Out Date</th>
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

        var table;

        $('#load_attendance_button').on('click', function() {
            var branchElem = $('#branch');
            var departmentElem = $('#department');
            var employeeElem = $('#employee');
            var employeeIdElem = $('#employee_id');
            var fromDateElem = $('#from_date');
            var nepaliFromDateElem = $('#nepali_from_date');
            var toDateElem = $('#to_date');
            var nepalitoDateElem = $('#nepali_to_date');

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
                $('<div class="fv-plugins-message-container invalid-feedback"><div data-fiedivld="name"-validator="notEmpty">The to date must be a date after or equal to from date.</div></div>')
                    .insertAfter(toDateElem.parent());
                return;
            }

            const date1 = $("#from_date").val();
            const date2 = $("#to_date").val();
            var url = "{{ route('api.get-employee-work-hour') }}";
            data = {
                'employee_id': $('#employee_id').val(),
                'from_date': date1,
                'to_date': date2
            };
            $.ajax({
                method: 'GET',
                url: url,
                data: data,
                success: function(response) {
                    response = response.data;
                    if (response.length == 0) {
                        toastr.error(
                            'For work hour assignment: <a href="{{ route('work-hour-assignment.create') }}"><button type="button" class="btn btn-light btn-sm">click here</button></a>',
                            'No Work Hour assigned to the employee on the selected date(s).');
                    } else {
                        var html = '';
                        response.forEach((e, i) => {
                            if (e.attendances.length > 0) {
                                e.attendances.forEach((f, j) => {
                                    html +=
                                        `<tr class="border-color row${i}" id="row${i}-shift${f.shift}" data-shift="${f.shift}">`
                                    if (f.shift == 1) {
                                        html += `<td class="border-right">
                                            ${e.assigned_date} <br /> ${NepaliFunctions.AD2BS(e.assigned_date)}
                                            <input type="hidden" class="form-control border-0 mxtb" name="force_attendance[${i}][date]" value="${e.assigned_date}" />
                                        </td>
                                        <td class="border-right">
                                            ${e.work_hour.name}<br />(${e.work_hour.in_time} - ${e.work_hour.out_time})
                                            <input type="hidden" class="form-control border-0 mxtb" name="force_attendance[${i}][work_hour]" value="${e.work_hour.id}" />
                                        </td>`;
                                    } else {
                                        html +=
                                            `<td></td><td class="border-right"></td>`;
                                    }
                                    html += `<td class="border-right">
                                        Shift ${f.shift}
                                        <input type="hidden" class="form-control border-0 mxtb shift" name="force_attendance[${i}][shift][0][shift]" value="${f.shift}" />
                                    </td>`;
                                    if (f.shift == 1) {
                                        html += `<td class="border-right text-center">
                                            <button type="button" class="btn btn-success btn-sm add-shift" data-index="${i}" data-assigned_date="${e.assigned_date}">+</button>
                                        </td>`;
                                    } else {
                                        html += `<td class="border-right text-center">
                                            <button type="button" class="btn btn-danger btn-sm remove-shift" data-index="${i}">-</button>
                                        </td>`;
                                    }
                                    html += `<td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${i}][shift][0][in_date]" value="${f.in_date ? f.in_date : e.assigned_date}" />
                                    </td>
                                    <td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${i}][shift][0][in_time]" value="${f.in_time}" />
                                    </td>
                                    <td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${i}][shift][0][out_date]" value="${f.out_date ? f.out_date : e.assigned_date}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${i}][shift][0][out_time]" value="${f.out_time}" />
                                    </td>`;
                                    html += `</tr>`;
                                })
                            } else {
                                html += `<tr class="border-color row${i}" id="row${i}-shift1" data-shift="1">
                                    <td class="border-right">
                                        ${e.assigned_date} <br /> ${NepaliFunctions.AD2BS(e.assigned_date)}
                                        <input type="hidden" class="form-control border-0 mxtb" name="force_attendance[${i}][date]" value="${e.assigned_date}" />
                                    </td>
                                    <td class="border-right">
                                        ${e.work_hour.name}<br />(${e.work_hour.in_time} - ${e.work_hour.out_time})
                                        <input type="hidden" class="form-control border-0 mxtb" name="force_attendance[${i}][work_hour]" value="${e.work_hour.id}" />
                                    </td>
                                    <td class="border-right">
                                        Shift 1
                                        <input type="hidden" class="form-control border-0 mxtb shift" name="force_attendance[${i}][shift][0][shift]" value="1" />
                                    </td>
                                    <td class="border-right text-center">
                                        <button type="button" class="btn btn-success btn-sm add-shift" data-index="${i}" data-assigned_date="${e.assigned_date}">+</button>
                                    </td>
                                    <td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${i}][shift][0][in_date]" value="${e.assigned_date}" />
                                    </td>
                                    <td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${i}][shift][0][in_time]" value="" />
                                    </td>
                                    <td class="border-right">
                                        <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${i}][shift][0][out_date]" value="${e.assigned_date}" />
                                    </td>
                                    <td>
                                        <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${i}][shift][0][out_time]" value="" />
                                    </td>
                                </tr>`;
                            }
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
        tbody = $('#attendance_table tbody');
        $(document).on('click', '.add-shift', function() {
            index = $(this).data('index');
            assigned_date = $(this).data('assigned_date');
            shift = tbody.find('tr').filter('.row' + index).last().data('shift');
            tbody.find('tr#row' + index + '-shift' + shift).after(`<tr class="border-color row${index}" id="row${index}-shift${shift + 1}" data-shift="${shift + 1}">
                <td></td>
                <td class="border-right"></td>
                <td class="border-right">
                    Shift ${shift + 1}
                    <input type="hidden" class="form-control border-0 mxtb shift" name="force_attendance[${index}][shift][${shift}][shift]" value="${shift + 1}" />
                </td>
                <td class="border-right text-center">
                    <button type="button" class="btn btn-danger btn-sm remove-shift" data-index="${index}">-</button>
                </td>
                <td class="border-right">
                    <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${index}][shift][${shift}][in_date]" value="${assigned_date}" />
                </td>
                <td class="border-right">
                    <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${index}][shift][${shift}][in_time]" value="" />
                </td>
                <td class="border-right">
                    <input type="text" class="form-control border-0 mxtb datepicker" name="force_attendance[${index}][shift][${shift}][out_date]" value="${assigned_date}" />
                </td>
                <td>
                    <input type="text" class="form-control border-0 mxtb timepicker" name="force_attendance[${index}][shift][${shift}][out_time]" value="" />
                </td>
            <tr>`);
            $(".timepicker").flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
        $(document).on('click', '.remove-shift', function() {
            $(this).parent().parent().remove();
        });
    </script>
    @include('partials.dropdown-hierarchy.script')
    @if ($errors->has('force_attendance') && $errors->count() == 1)
        <script>
            toastr.error(
                'Possible reasons:<br/><ul><li>Load button was not clicked(maybe).</li><li>Missing input data</li><li>No Work Hour assigned to the employee on the selected date(s). For Work Hour assignment: <a href="{{ route('work-hour-assignment.create') }}"><button type="button" class="btn btn-light btn-sm">click here</button></a></li><li>Employee does not exist</li></ul>',
                'Force Attendance data(list) is missing.');
        </script>
    @endif
@endsection
