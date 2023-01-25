@extends('layouts.app')
@section('department', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ $page }}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $page }}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">List</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    @can('view-department')
                        <div class="m-0">
                            <a href="{{ route('department.index') }}"
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
                    @can('add-department')
                        <a href="{{ route('department.create') }}" class="btn btn-sm btn-primary">Create</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">{{ $page }} List</span>
                            {{-- <span class="text-muted mt-1 fw-bold fs-7">Manage you permission group </span> --}}
                        </h3>
                        @can('add-department')
                            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                                 data-bs-trigger="hover"
                                 title="">
                                <a href="{{ route('department.create') }}" class="btn btn-primary">
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
                        @endcan
                    </div>
                    <div class="card-body pt-0">
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id="department-table"
                                       class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                    <thead>
                                    <tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Mobile</th>
                                        <th>Company</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($records as $key => $data)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $data->name ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->code ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->address ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->email ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->phone ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->mobile ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                {{ $data->company_detail->name ?? 'Not Assigned' }}
                                            </td>
                                            <td>
                                                <div class="d-flex flex-shrink-0">
                                                    @can('edit-department')
                                                        <a href="{{ route('department.edit', $data->id) }}"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                          d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                                          fill="currentColor"></path>
                                                                    <path
                                                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                                        fill="currentColor"></path>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    @endcan
                                                    <a href="javascript:void(0);" data-target-id="{{ $data->id }}"
                                                       data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                                                       class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                       title="Assign Off Days" data-bs-toggle="modal"
                                                       data-bs-target="#kt_modal_new_target">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                             height="16" fill="currentColor"
                                                             class="bi bi-list-task" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd"
                                                                  d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z"/>
                                                            <path
                                                                d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z"/>
                                                            <path fill-rule="evenodd"
                                                                  d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z"/>
                                                        </svg>
                                                    </a>
                                                    @can('delete-department')
                                                        <form id="form{{ $data->id }}"
                                                              action="{{ route('department.destroy', $data->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                        <a href="javascript:viod(0);"
                                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm delete"
                                                           data-id="{{ $data->id }}"
                                                           data-name="{{ $data->name }}">
                                                            <span class="svg-icon svg-icon-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none">
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
                                                    @endcan
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

    <!--begin::Modal - New Prefix-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                      rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                      transform="rotate(45 7.41422 6)" fill="currentColor"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('assignOffDays') }}">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Assign Off Days To <span id="departmentName"></span></h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <input type="hidden" id="departmentId" name="department_id">
                            <input type="hidden" id="dynamicId" name="id">
                            <input type="hidden" name="key" id="keyname">
                            <div class="fv-row w-100 flex-md-root">
                                <label class="required form-label">Days</label>
                                <div class="d-flex gap-5" id="daysSection">
                                    <select class="form-select mb-2" id="assignedDays" name="days[]"
                                            data-control="select2" data-hide-search="false"
                                            data-placeholder="Select Days"
                                            required multiple>
                                        <option></option>
                                        @foreach (getDays() as $day)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
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
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->
@endSection
@section('script')
    <script>
        $(document).ready(function () {
            $("#department-table").DataTable({
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
            $(".delete").on("click", function () {
                event.preventDefault();
                var t = $(this);
                var name = t.data("name");
                var id = t.data("id");
                Swal.fire({
                    text: "You are about to delete " + name + " data. Are you sure?",
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
                        $("#form" + id).submit();
                    }
                })
            });


            $("#kt_modal_new_target_submit").on('click', function (e) {
                $('.require').css('display', 'none');
                e.preventDefault();
                var formData = ($("#kt_modal_new_target_form").serialize());
                var action = $("#kt_modal_new_target_form").attr('action');
                $.ajax({
                    url: action,
                    type: 'post',
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.db_error) {
                            toastr.warning(data.db_error);
                        } else if (!data.db_error && !data.errors) {
                            toastr.success(data.message);
                            $("#kt_modal_new_target").modal('hide');
                            location.reload();
                        }
                        if (data.errors) {
                            e.stopPropagation();
                            $.each(data.errors, function (key, value) {
                                $('.' + key).css('display', 'block').html(value);
                            })
                        } else {
                            $("#kt_modal_new_target").modal('hide');
                        }
                    }
                });
            });


            $("#kt_modal_new_target").on("hidden.bs.modal", function () {
                $(".require").css("display", "none");
                $(this).find('form')[0].reset();
            });

            $("#kt_modal_new_target").on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('target-id');
                var department_name = $(e.relatedTarget).data('name');
                var offDaysList = JSON.parse('<?= json_encode((array)getDays()) ?>');
                $("#departmentName").html(department_name);
                $("#keyname").val('department_' + id);
                $("#departmentId").val(id);
                if (id != "undefined" && id != undefined && id != 'null' && id != null) {
                    var url = "{{ route('departmentOffDays', ':id') }}",
                        url = url.replace(":id", id);
                    // $.ajax({
                    //    url: url,
                    //    dataType: 'html',
                    //    success: function(res){
                    //        $("#daysSection").html(res);
                    //    }
                    // });
                    $.get(url, function (res) {
                        if (res.status == false) {
                            // toastr.error(res.message);
                        } else {
                            $("#dynamicId").val(res.dynamic_id);
                            let off_days = res.off_days;
                            $("#assignedDays").html("<option value=''></option>");
                            $.each(offDaysList, function (key, off_day) {
                                let $option = $('<option></option>').val(off_day).html(
                                    off_day);
                                off_days.filter(value => {
                                    if ($option[0] !== 'undefined' && $option[0] !==
                                        undefined && $option[0].childNodes[0]
                                            .nodeValue === value) {
                                        $option = $option.attr('selected',
                                            'selected');
                                    }
                                });
                                $("#assignedDays").append($option);
                            });


                        }
                    });
                }
            });
        })

        const areCommonElements = (offDaysList, off_days) => {
            const [shortArr, longArr] = (offDaysList.length < off_days.length) ? [offDaysList, off_days] : [off_days,
                offDaysList
            ];
            const longArrSet = new Set(longArr);
            shortArr.map(function (k) {
                return k;
            });
            return shortArr;
        };
    </script>
@endSection
