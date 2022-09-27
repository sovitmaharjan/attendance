@extends("layouts.app")
@section(request()->setup, 'active')
@section("content")
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dynamic Values</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            {{--                            <a href="{{ route("dashboard") }}" class="text-muted text-hover-primary">Home</a>--}}
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Dynamic Values</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">List</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Dynamic Values {{ucwords(str_replace("_", " ", request('setup')))}}</span>
                        </h3>
                        <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                             data-bs-trigger="hover"
                             title="">
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal"
                               data-bs-target="#kt_modal_new_target">
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                              transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                              fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="table-responsive">
                                <table id="kt_datatable_example_5"
                                       class="table table-row-bordered gy-5 gs-7 border rounded align-middle">
                                    <thead>
                                    <tr class="text-start text-gray-800 fw-bolder fs-7 text-uppercase gs-0">
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($dynamic_values) > 0)
                                        @foreach($dynamic_values as $key => $dynamic_value)
                                            <tr>
                                                <td>{{$dynamic_value->name}}</td>
                                                <td>{{$dynamic_value->status ? 'Active' : 'Inactive'}}</td>
                                                <td>
                                                    <div class="d-flex flex-shrink-0">
                                                        <a href="javascript:void(0)"
                                                           data-target-id="{{$dynamic_value->id}}"
                                                           data-bs-toggle="modal" data-bs-target="#kt_modal_new_target"
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
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No Data Found</td>
                                        </tr>
                                    @endif
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
									<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="currentColor"/>
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
                    <form id="kt_modal_new_target_form" class="form" action="{{route('dynamic_values.save')}}">
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Add {{ucwords(str_replace('_', ' ', request()->setup))}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{ucwords(str_replace('_', ' ', request()->setup))}}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                   title="Specify a target priorty"></i>
                            </label>
                            <!--end::Label-->
                            <input type="hidden" id="Id" name="id">
                            <input class="form-control form-control-solid" value="" name="name" type="text" id="Name"/>
                            <input class="form-control form-control-solid" value="{{request()->setup}}" name="key"
                                   type="hidden" id="dataKey"/>
                            <span class="text-danger require name"></span>
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
@section("script")
    <script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
    {{--    <script src="{{asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>--}}
    <script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>

    <script>
        $(document).ready(function () {
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

        $(document).ready(function () {
            $("#kt_modal_new_target").on("hidden.bs.modal", function () {
                $(".require").css("display", "none");
                $(this).find('form')[0].reset();
            });

            $("#kt_modal_new_target").on('show.bs.modal', function (e) {
                var id = $(e.relatedTarget).data('target-id');
                if (id != "undefined" && id != undefined && id != 'null' && id != null) {
                    var url = "{{route('dynamic_values.edit', ':id')}}",
                        url = url.replace(":id", id);
                    $.get(url, function (res) {
                        let dynamic_value = res.dynamic_value;
                        $("#Id").val(dynamic_value.id);
                        $("#Name").val(dynamic_value.name);
                        $("#dataKey").val(dynamic_value.key);
                    });
                }
            });
        });
    </script>
@endSection
