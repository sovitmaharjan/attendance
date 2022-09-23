@extends('layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Employee</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Employee</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="m-0">
                        <a href="{{ route('employee.index') }}"
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
                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form class="form d-flex flex-column flex-lg-row" method="POST" action="{{ route('employee.store') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="required">Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline image-input-empty"
                                     data-kt-image-input="true"
                                     style="background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }})">
                                    <div class="image-input-wrapper w-200px h-200px bgi-position-center"
                                         style="background-size: 95%;"></div>
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change image">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                    </label>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="Remove image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the employee image. Only *.png, *.jpg and *.jpeg image
                                    files
                                    are accepted
                                </div>
                                @error('image')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="image" data-validator="notEmpty">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                            <div class="card-body pt-0">
                                <label class="form-label required">Login Id</label>
                                <input type="text" name="login_id" class="form-control mb-2"
                                       value="{{ old('login_id') }}"
                                       required/>
                                <div class="text-muted fs-7 mb-7">Select atleast company to generate login id.
                                </div>
                                @error('title')
                                <div class="fv-plugins-message-container invalid-feedback">
                                    <div data-field="title" data-validator="notEmpty">{{ $message }}</div>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header card-header-info">
                                <div class="card-title">
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span
                                            class="required"></span> are required </span>
                                </div>
                            </div>
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Personal Information</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Name</label>
                                            <div class="d-flex gap-5">
                                                <select class="form-select mb-2" name="prefix" data-control="select2"
                                                        data-hide-search="false" data-placeholder="Select Prefix"
                                                        required>
                                                    <option></option>
                                                    @foreach(getDynamicValues('prefix') as $prefix)
                                                        <option
                                                            value="{{$prefix->name}}" @selected(old('prefix') == $prefix->name)>{{$prefix->name}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="text" class="form-control mb-2" name="firstname"
                                                       value="{{ old('firstname') }}" placeholder="Firstname" required/>
                                                <input type="text" class="form-control mb-2" name="middlename"
                                                       value="{{ old('middlename') }}" placeholder="Middlename"/>
                                                <input type="text" class="form-control mb-2" name="lastname"
                                                       value="{{ old('lastname') }}" placeholder="Lastname" required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Gender</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach(getGenders() as $k => $gender)
                                                    <input class="form-check-input" type="radio" name="gender"
                                                           value="{{$gender->value}}"
                                                           id="{{strtolower($gender->value)}}"
                                                           @selected(old('gender') == $gender->value) required/>
                                                    <label class="form-check-label mx-3"
                                                           for="male">{{$gender->name}} </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Marital Status</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach(getDynamicValues('marital_status') as $k => $marital_status)
                                                    <input class="form-check-input" type="radio" name="marital_status"
                                                           value="{{$marital_status->name}}"
                                                           id="{{strtolower(str_replace('_', '', $marital_status->name))}}"
                                                           @selected(old('marital_status') == $marital_status->name) required/>
                                                    <label class="form-check-label mx-3"
                                                           for="single">{{$marital_status->name}} </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">DOB</label>
                                            <div class="d-flex gap-5">
                                                <input type="text" class="form-control mb-2 eng_date" name="dob"
                                                       onchange="engtonep($(this), 'nep_date')"
                                                       value="{{ old('dob') }}" placeholder="yyyy-dd-mm" id="eng_date"
                                                       readonly
                                                       required/>
                                                <input type="text" class="form-control mb-2 nep_date" name="nepali_dob"
                                                       onclick="neptoeng('nep_date', 'eng_date')"
                                                       value="{{ old('nepali_dob') }}" placeholder="yyyy-dd-mm"
                                                       id="nep_date"/>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Join Date</label>
                                            <div class="d-flex gap-5">
                                                <input type="text" onchange="engtonep($(this), 'nep_join_date')"
                                                       class="form-control mb-2 join_date" name="join_date"
                                                       value="{{ old('join_date') }}" placeholder="yyyy-dd-mm"
                                                       id="join_date"
                                                       required readonly/>
                                                <input type="text" onclick="neptoeng('nep_join_date', 'eng_join_date')"
                                                       class="form-control mb-2 nep_join_date" name="nepali_join_date"
                                                       value="{{ old('nepali_join_date') }}" placeholder="yyyy-dd-mm"
                                                       id="nep_join_date" readonly/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Phone</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="phone"
                                                       value="{{ old('phone') }}" placeholder="9800000000"/>
                                            </div>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Address</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="address"
                                                       value="{{ old('address') }}"
                                                       placeholder="Putalisadak, Kathmandu"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Email</label>
                                            <input type="text" class="form-control mb-2" name="email"
                                                   value="{{ old('email') }}" placeholder="example@mail.com" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Official Information</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Branch</label>
                                            <select class="form-select mb-2" name="branch_id" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Branch"
                                                    required>
                                                <option></option>
                                                @foreach ($branch as $item)
                                                    <option
                                                        value="{{ $item->id }}" {{ old('branch_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Department</label>
                                            <select class="form-select mb-2" name="department_id" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Department"
                                                    required>
                                                <option></option>
                                                @foreach ($department as $item)
                                                    <option
                                                        value="{{ $item->id }}" {{ old('department_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Designation</label>
                                            <select class="form-select mb-2" name="designation_id"
                                                    data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Designation">
                                                <option></option>
                                                @foreach ($designation as $item)
                                                    <option
                                                        value="{{ $item->id }}" {{ old('designation_id') == $item->id ? 'selected' : '' }}>{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Role</label>
                                            <select class="form-select mb-2" name="role_id" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Role">
                                                <option></option>
                                                @foreach($GLOBALS['roles'] as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Supervisor</label>
                                            <select class="form-select mb-2" name="supervisor_id" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Supervisor"
                                                    required>
                                                <option></option>
                                                <option value="Mr." {{ old('user_type') == 'Mr.' ? 'selected' : '' }}>
                                                    Mr.
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Status</label>
                                            <select class="form-select mb-2" name="status" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Employee Status"
                                                    required>
                                                <option></option>
                                                @foreach(getDynamicValues('employee_status') as $k => $employee_status)
                                                    <option
                                                        value="{{$employee_status->name}}" @selected(old('status') == $employee_status->name)>
                                                        {{$employee_status->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Type</label>
                                            <select class="form-select mb-2" name="type" data-control="select2"
                                                    data-hide-search="false" data-placeholder="Select Employee Type"
                                                    required>
                                                <option></option>
                                                @foreach(getDynamicValues('employee_type') as $k => $employee_type)
                                                    <option
                                                        value="{{$employee_type->name}}" @selected(old('type') == $employee_type->name)>
                                                        {{$employee_type->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Official Email</label>
                                            <input type="text" class="form-control mb-2" name="official_email"
                                                   value="{{ old('official_email') }}" placeholder="example@mail.com"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('employee.index') }}" class="btn btn-light me-5">Cancel</a>
                            <button type="submit" class="btn btn-primary">
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
    <script>
        $(function () {
            $('.eng_date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
            });
            $('.join_date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                todayBtn: 'linked',
                clearBtn: true,
                autoclose: true,
            });
        });
    </script>
@endsection
