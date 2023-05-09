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
                        <li class="breadcrumb-item text-dark">List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @can('view-employee')
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
                    @endcan
                    {{-- @can('add-leave-application') --}}
                        <a href="{{ route('leave-application.create') }}" class="btn btn-sm btn-primary">Create</a>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Leave Application List</span>
                            {{-- <span class="text-muted mt-1 fw-bold fs-7">Manage you employee group </span> --}}
                        </h3>
                        {{-- @can('add-leave-application') --}}
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                            title="">
                            <a href="{{ route('leave-application.create') }}" class="btn btn-primary">
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
                        {{-- @endcan --}}
                    </div>
                    <div class="card-body pt-0">
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id="kt_datatable_example_5"
                                    class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                    <thead>
                                        <tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Leave</th>
                                            <th>Date</th>
                                            <th>Duration</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leave_applications as $key => $leave_application)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $leave_application->employee->full_name }}</td>
                                                <td>{{ $leave_application->leave->name }}</td>
                                                <td>{{ $leave_application->from_date }} - {{ $leave_application->to_date }}
                                                </td>
                                                <td>{{ $leave_application->leave_duration }}</td>
                                                <td>{{ $leave_application->status }}</td>
                                                <td>
                                                    <div class="d-flex flex-shrink-0">
                                                        @if ($leave_application->status == 'pending')
                                                            <form id="approve-form-{{ $leave_application->id }}"
                                                                action="{{ route('leave-application.approve', $leave_application->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('patch')
                                                            </form>
                                                            <a href="javascript:viod(0);"
                                                                data-id="{{ $leave_application->id }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 approve">
                                                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M9.89557 13.4982L7.79487 11.2651C7.26967 10.7068 6.38251 10.7068 5.85731 11.2651C5.37559 11.7772 5.37559 12.5757 5.85731 13.0878L9.74989 17.2257C10.1448 17.6455 10.8118 17.6455 11.2066 17.2257L18.1427 9.85252C18.6244 9.34044 18.6244 8.54191 18.1427 8.02984C17.6175 7.47154 16.7303 7.47154 16.2051 8.02984L11.061 13.4982C10.7451 13.834 10.2115 13.834 9.89557 13.4982Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                            <form id="cancel-form-{{ $leave_application->id }}"
                                                                action="{{ route('leave-application.cancel', $leave_application->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('patch')
                                                            </form>
                                                            <a href="javascript:viod(0);"
                                                                data-id="{{ $leave_application->id }}"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 cancel">
                                                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg
                                                                        width="32" height="32" viewBox="0 0 32 32"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <rect x="9.39844" y="20.7144"
                                                                            width="16" height="2.66667"
                                                                            rx="1.33333"
                                                                            transform="rotate(-45 9.39844 20.7144)"
                                                                            fill="currentColor" />
                                                                        <rect x="11.2852" y="9.40039"
                                                                            width="16" height="2.66667"
                                                                            rx="1.33333"
                                                                            transform="rotate(45 11.2852 9.40039)"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        @endif
                                                        {{-- @can('delete-leave_application') --}}
                                                        @if ($leave_application->status != 'approved')
                                                            <form id="delete-form-{{ $leave_application->id }}"
                                                                action="{{ route('leave-application.destroy', $leave_application->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                            <a href="javascript:viod(0);"
                                                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete"
                                                                data-id="{{ $leave_application->id }}">
                                                                <span class="svg-icon svg-icon-3">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24"
                                                                        fill="none">
                                                                        <path
                                                                            d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                                            fill="currentColor"></path>
                                                                        <path opacity="0.5"
                                                                            d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                                            fill="currentColor"></path>
                                                                        <path opacity="0.5"
                                                                            d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                                            fill="currentColor"></path>
                                                                    </svg>
                                                                </span>
                                                            </a>
                                                        @endif
                                                        {{-- @endcan --}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
    <script>
        $(document).on("click", ".approve", function() {
            event.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are yopu sure?',
                text: "You are about to approve this record. This process cannot be undone",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#approve-form-" + id).submit();
                }
            })
        });

        $(document).on("click", ".cancel", function() {
            event.preventDefault();
            var id = $(this).data("id");
            Swal.fire({
                title: 'Are yopu sure?',
                text: "You are about to cancel this record. This process cannot be undone",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#cancel-form-" + id).submit();
                }
            })
        });

        $(document).ready(function() {
            $("#kt_datatable_example_5").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });

            $('.eng_date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
            });
            $('.eng_dat').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
            });
        });

        $(function() {


            $("#kt_modal_new_target").on("hidden.bs.modal", function() {
                $(".require").css("display", "none");
                $(this).find('form')[0].reset();
            });

            $("#kt_modal_new_target").on('shown.bs.modal', function(e) {
                var id = $(e.relatedTarget).data('target-id');
                var employee_name = $(e.relatedTarget).data('name');
                $("#employeeName").html(employee_name);
                $("#employeeId").val(id);
            });
        });

        $("#kt_modal_new_target_submit").on('click', function(e) {
            $('.require').css('display', 'none');
            e.preventDefault();
            var formData = ($("#kt_modal_new_target_form").serialize());
            var action = $("#kt_modal_new_target_form").attr('action');
            $.ajax({
                url: action,
                type: 'post',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.success === true) {
                        toastr.success(data.message);
                        $("#kt_modal_new_target").modal('hide');
                        location.reload();
                    }
                },
                error: function(err) {
                    $.each(err.responseJSON.errors, function(key, value) {
                        $('.' + key).css('display', 'block').html(value[0]);
                    })
                }
            });
        });
    </script>
@endSection
