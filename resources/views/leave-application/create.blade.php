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
                    <a href="{{ route('leave-application.create') }}" class="btn btn-sm btn-primary">Create</a>
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
                                                <select class="form-select" id="leave_id" name="leave"
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
                                                    autocomplete="off" value="{{ old('from_date') }}" required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control nepali_from_date"
                                                    id="nepali_from_date" name="nepali_from_date" autocomplete="off"
                                                    value="{{ old('nepali_from_date') }}" placeholder="yyyy-dd-mm"
                                                    required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">To</label>
                                            <div class="d-flex">
                                                <input type="text" autocomplete="off" class="form-control to_date"
                                                    value="{{ old('to_date') }}" date-id="to" placeholder="yyyy-dd-mm"
                                                    id="to_date" name="to_date" required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex">
                                                <input type="text" autocomplete="off"
                                                    class="form-control nepali_to_date" id="nepali_to_date"
                                                    name="nepali_to_date" value="{{ old('nepali_to_date') }}"
                                                    placeholder="yyyy-dd-mm" required />
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Duration</label>
                                            <div class="d-flex">
                                                <input type="text" id="duration" name="duration"
                                                    class="form-control" value="{{ old('duration') }}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Leave Reason</label>
                                            <textarea name="description" class="form-control" id="description" rows="2" required>{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Leave Balance</label>
                                        </div>
                                    </div>
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
                                                        <th class="border-right" width="14%">Total Leave Assigned</th>
                                                        <th class="border-right" width="14%">Used</th>
                                                        <th class="border-right" width="14%">Available</th>
                                                        <th class="border-right" width="14%">Applied</th>
                                                        <th class="border-right" width="14%">Pending</th>
                                                        <th class="border-right" width="14%">Approved</th>
                                                        <th width="14%">Cancelled</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input type="hidden" id="input_total_leave_assigned"
                                                        name="total_leave_assigned"
                                                        value="{{ old('total_leave_assigned') }}" />
                                                    <input type="hidden" id="input_used" name="used"
                                                        value="{{ old('used') }}" />
                                                    <input type="hidden" id="input_available" name="available"
                                                        value="{{ old('available') }}" />
                                                    <input type="hidden" id="input_applied" name="applied"
                                                        value="{{ old('applied') }}" />
                                                    <input type="hidden" id="input_pending" name="pending"
                                                        value="{{ old('pending') }}" />
                                                    <input type="hidden" id="input_approved" name="approved"
                                                        value="{{ old('approved') }}" />
                                                    <input type="hidden" id="input_cancelled" name="cancelled"
                                                        value="{{ old('cancelled') }}" />
                                                    <tr>
                                                        <td id="total_leave_assigned" class="border-right">
                                                            {{ old('total_leave_assigned') ?? '-' }}</td>
                                                        <td id="used" class="border-right">{{ old('used') ?? '-' }}
                                                        </td>
                                                        <td id="available" class="border-right">
                                                            {{ old('available') ?? '-' }}</td>
                                                        <td id="applied" class="border-right">
                                                            {{ old('applied') ?? '-' }}</td>
                                                        <td id="pending" class="border-right">
                                                            {{ old('pending') ?? '-' }}</td>
                                                        <td id="approved" class="border-right">
                                                            {{ old('approved') ?? '-' }}</td>
                                                        <td id="cancelled" class="border-right">
                                                            {{ old('cancelled') ?? '-' }}</td>
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
        var total_leave_assigned, used, available, applied, pending, approved, cancelled;

        $('.employee_id, .employee').on('keyup', delay(function() {
            getLeaveApplicationData();
        }, 700));

        $('#leave_id').on('select2:select', function() {
            getLeaveApplicationData();
        });

        function getLeaveApplicationData() {
            var employee_id = $('#employee').val();
            var leave_id = $('#leave_id').val();
            var url = "{{ route('ajax.get-leave-application-data') }}";
            $.ajax({
                method: 'POST',
                url: url,
                data: {
                    employee_id: employee_id,
                    leave_id: leave_id
                },
                success: function(response) {
                    var data = response.data;
                    total_leave_assigned = data.total_leave_assigned;
                    used = data.used;
                    available = data.available;
                    applied = data.applied;
                    pending = data.pending;
                    approved = data.approved;
                    cancelled = data.cancelled;
                    $('#total_leave_assigned').html(data.total_leave_assigned);
                    $('#used').html(data.used);
                    $('#available').html(data.available);
                    $('#applied').html(data.applied);
                    $('#pending').html(data.pending);
                    $('#approved').html(data.approved);
                    $('#cancelled').html(data.cancelled);

                    $('#input_total_leave_assigned').val(data.total_leave_assigned);
                    $('#input_used').val(data.used);
                    $('#input_available').val(data.available);
                    $('#input_applied').val(data.applied);
                    $('#input_pending').val(data.pending);
                    $('#input_approved').val(data.approved);
                    $('#input_cancelled').val(data.cancelled);
                }
            });
        }

        englishToNepaliDatePicker($('.from_date'), $('.nepali_from_date'), function() {
            beforePickingDate();
            dateDiff();
        });
        nepaliToEnglishDatepicker($('.nepali_from_date'), $('.from_date'), function() {
            beforePickingDate();
            dateDiff();
        });
        englishToNepaliDatePicker($('.to_date'), $('.nepali_to_date'), function() {
            beforePickingDate();
            dateDiff();
        });
        nepaliToEnglishDatepicker($('.nepali_to_date'), $('.to_date'), function() {
            beforePickingDate();
            dateDiff();
        });

        function dateDiff() {
            const date1 = new Date($('.from_date').val() ? $('.from_date').val() : $('.to_date').val());
            const date2 = new Date($('.to_date').val() ? $('.to_date').val() : $('.from_date').val());
            const diffTime = Math.abs(date2 - date1);
            const days = (Math.ceil(diffTime / (1000 * 60 * 60 * 24))) + 1;
            $('#duration').val(days);
            if (days > available) {
                toastr.error('', 'Leave duration exceed available days');
                toDateElem.val('');
                nepaliToDateElem.val('');
            }
        }

        function beforePickingDate() {
            var branchElem = $('#branch');
            var departmentElem = $('#department');
            var employeeElem = $('#employee');
            var employeeIdElem = $('#employee_id');
            var leaveElem = $('#leave_id');
            var fromDateElem = $('#from_date');
            var nepaliFromDateElem = $('#nepali_from_date');
            var toDateElem = $('#to_date');
            var nepaliToDateElem = $('#nepali_to_date');

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
            !leaveElem.val() ? message('employee id').insertAfter(leaveElem.parent()) : '';

            if (!branchElem.val() || !departmentElem.val() || !employeeElem.val() || !employeeIdElem.val() || !leaveElem
                .val()) {
                fromDateElem.val('');
                nepaliFromDateElem.val('');
                toDateElem.val('');
                nepaliToDateElem.val('');
                return 0;
            }

            if (new Date(fromDateElem.val()) > new Date(toDateElem.val())) {
                $('<div class="fv-plugins-message-container invalid-feedback"><div data-fiedivld="name"-validator="notEmpty">The to date must be a date after or equal to from date.</div></div>')
                    .insertAfter(toDateElem.parent());
                toDateElem.val('');
                nepaliToDateElem.val('');
                return 0;
            }
        }

        $('.from_date, .to_date, .nepali_from_date, .nepali_to_date').on('change', function() {
            if (beforePickingDate() != 0) {
                var to_date = $('#to_date').val();
                var from_date = $('#from_date').val();
                var leave_id = $('#leave_id').val();
                var employee_id = $('#employee_id').val();
                var url = "{{ route('ajax.check-leave-application-date') }}";
                $.ajax({
                    method: 'POST',
                    url: url,
                    data: {
                        to_date: to_date,
                        from_date: from_date,
                        leave_id: leave_id,
                        employee_id: employee_id
                    },
                    success: function(response) {
                        if (response) {
                            toastr.info(response.message, response.status);
                            if (response.status != 'cancelled') {
                                $('.from_date').val('');
                                $('.nepali_from_date').val('');
                                $('.to_date').val('');
                                $('.nepali_to_date').val('');
                            }
                        }
                    }
                });
            }
        })
    </script>
@endSection
