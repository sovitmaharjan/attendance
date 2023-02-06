@extends('layouts.app')
@section('employee', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/custom/dropzone.css') }}" />
    <link href="{{ asset('assets/custom/cropper.css') }}" rel="stylesheet" />
    <style>
        .image_area {
            position: relative;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        .overlay {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }

        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
        }

        .text {
            color: #333;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
@endsection
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
                    @can('view-employee')
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
                    @endcan
                    @can('add-employee')
                        <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">Create</a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('employee.update', $employee->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="required">Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/media/svg/files/blank-image.svg') }})">
                                    <div data-image="{{ $employee->getFirstMedia('image') ? 'background-image: url(' . $employee->getFirstMedia('image')->getUrl() . ')' : '' }}"
                                        class="image-input-wrapper w-200px h-200px bgi-position-center"
                                        style="background-size: 95%; {{ $employee->getFirstMedia('image') ? 'background-image: url(' . $employee->getFirstMedia('image')->getUrl() . ')' : '' }}"
                                        id="uploaded_image"></div>
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                        <i class="bi bi-pencil-fill fs-7" id="changeImageIcon"></i>
                                        <input type="file" accept=".png, .jpg, .jpeg" id="upload_image" />
                                    </label>
                                    <input type="hidden" name="base64" id="base64" />
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image"
                                        id="cancelImageSpan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image"
                                        id="removeImageSpan">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the employee image. Only *.png, *.jpg and *.jpeg image
                                    files
                                    are accepted
                                </div>
                                @error('image')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="card-body pt-0">
                                <label class="form-label required">Login Id</label>
                                <input type="text" name="login_id" class="form-control mb-2"
                                    value="{{ old('login_id', generateLoginId(auth()->id())) }}" required readonly />
                                <div class="text-muted fs-7 mb-7">Select atleast company to generate login id.
                                </div>
                                @error('login_id')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header card-header-info">
                                <div class="card-title">
                                    <span class="mt-1 fs-7 text-danger">Fields with asterisk<span class="required"></span>
                                        are required </span>
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
                                                    data-hide-search="false" data-placeholder="Select Prefix" required>
                                                    <option></option>
                                                    @foreach (getDynamicValues('prefix') as $prefix)
                                                        <option value="{{ $prefix->name }}" @selected(old('prefix', $employee->prefix) == $prefix->name)>
                                                            {{ $prefix->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('prefix')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="text" class="form-control mb-2" name="firstname"
                                                    value="{{ old('firstname', $employee->firstname) }}"
                                                    placeholder="Firstname" autocomplete="off" required />
                                                @error('firstname')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="text" class="form-control mb-2" name="middlename"
                                                    value="{{ old('middlename', $employee->middlename) }}"
                                                    placeholder="Middlename" autocomplete="off" />
                                                @error('middlename')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <input type="text" class="form-control mb-2" name="lastname"
                                                    value="{{ old('lastname', $employee->lastname) }}"
                                                    placeholder="Lastname" autocomplete="off" required />
                                                @error('lastname')
                                                    <div class="fv-plugins-message-container invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Gender</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach (getGenders() as $k => $gender)
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        value="{{ $gender->value }}"
                                                        id="{{ strtolower($gender->value) }}" @checked(old('gender', $employee->gender) == $gender->value)
                                                        required />
                                                    <label class="form-check-label mx-3"
                                                        for="male">{{ $gender->name }} </label>
                                                @endforeach
                                            </div>
                                        </div>
                                        @error('gender')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Marital Status</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach (getDynamicValues('marital_status') as $k => $marital_status)
                                                    <input class="form-check-input" type="radio" name="marital_status"
                                                        value="{{ $marital_status->name }}"
                                                        id="{{ strtolower(str_replace('_', '', $marital_status->name)) }}"
                                                        @checked(old('marital_status', $employee->marital_status) == $marital_status->name) required />
                                                    <label class="form-check-label mx-3"
                                                        for="single">{{ $marital_status->name }} </label>
                                                @endforeach
                                            </div>
                                            @error('marital_status')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                                                    value="{{ old('dob', getFormattedDate($employee->dob)) }}"
                                                    placeholder="yyyy-dd-mm" id="eng_date" autocomplete="off" />
                                                <input type="text" class="form-control mb-2 nep_date"
                                                    name="nepali_dob" onclick="neptoeng('nep_date', 'eng_date')"
                                                    value="{{ old('nepali_dob', $employee->extra != null && $employee->extra['nepali_dob'] ? $employee->extra['nepali_dob'] : '') }}"
                                                    placeholder="yyyy-dd-mm" id="nep_date" />
                                            </div>
                                            @error('dob')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Join Date</label>
                                            <div class="d-flex gap-5">
                                                <input type="text" onchange="engtonep($(this), 'nep_join_date')"
                                                    class="form-control mb-2 join_date" name="join_date"
                                                    value="{{ old('join_date', getFormattedDate($employee->join_date)) }}"
                                                    placeholder="yyyy-dd-mm" id="join_date" autocomplete="off" />
                                                <input type="text" onclick="neptoeng('nep_join_date', 'eng_join_date')"
                                                    class="form-control mb-2 nep_join_date" name="nepali_join_date"
                                                    value="{{ old('nepali_join_date', $employee->extra != null && $employee->extra['nepali_join_date'] ? $employee->extra['nepali_join_date'] : '') }}"
                                                    placeholder="yyyy-dd-mm" id="nep_join_date" />
                                            </div>
                                            @error('join_date')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Phone</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="phone"
                                                    value="{{ old('phone', $employee->phone) }}" placeholder="9800000000"
                                                    autocomplete="off" />
                                            </div>
                                            @error('phone')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Address</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="address"
                                                    value="{{ old('address', $employee->address) }}"
                                                    placeholder="Putalisadak, Kathmandu" autocomplete="off" />
                                            </div>
                                            @error('address')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Citizenship Number</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="citizenship_no"
                                                    value="{{ old('citizenship_no', $employee->extra && array_key_exists('citizenship_no', $employee->extra) ? $employee->extra['citizenship_no'] : '') }}"
                                                    placeholder="05-01-27-87654" autocomplete="off" />
                                            </div>
                                            @error('citizenship_no')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Pan Number</label>
                                            <div class="d-flex">
                                                <input type="text" class="form-control mb-2" name="pan_no"
                                                    value="{{ old('pan_no', $employee->extra && array_key_exists('pan_no', $employee->extra) ? $employee->extra['pan_no'] : '') }}"
                                                    placeholder="1072345" autocomplete="off" />
                                            </div>
                                            @error('pan_no')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Email</label>
                                            <input type="text" class="form-control mb-2" name="email"
                                                value="{{ old('email', $employee->email) }}"
                                                placeholder="example@mail.com" autocomplete="off" required />
                                        </div>
                                        @error('email')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                                data-hide-search="false" data-placeholder="Select Branch" required>
                                                <option></option>
                                                @foreach ($branch as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('branch_id', $employee->branch_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('branch_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Department</label>
                                            <select class="form-select mb-2" name="department_id" data-control="select2"
                                                data-hide-search="false" data-placeholder="Select Department" required>
                                                <option></option>
                                                @foreach ($department as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('department_id', $employee->department_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('department_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Designation</label>
                                            <select class="form-select mb-2" name="designation_id" data-control="select2"
                                                data-hide-search="false" data-placeholder="Select Designation" required>
                                                <option></option>
                                                @foreach ($designation as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('designation_id', $employee->designation_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('designation_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Role</label>
                                            <select class="form-select mb-2" name="role_id" data-control="select2"
                                                data-hide-search="false" data-placeholder="Select Role" required>
                                                <option></option>
                                                @foreach ($GLOBALS['roles'] as $role)
                                                    <option value="{{ $role->id }}" @selected(old('role_id', $employee->role_id) == $role->id)>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Supervisor</label>
                                            <select class="form-select mb-2" name="supervisor_id" data-control="select2"
                                                data-hide-search="false" data-placeholder="Select Supervisor" required>
                                                <option></option>
                                                @foreach ($supervisors as $supervisor)
                                                    <option value="{{ $supervisor->id }}" @selected(old('supervisor_id', $employee->supervisor_id) == $supervisor->id)>
                                                        {{ $supervisor->full_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('supervisor_id')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                                                @foreach (getDynamicValues('employee_status') as $k => $employee_status)
                                                    <option value="{{ $employee_status->name }}"
                                                        @selected(old('status', $employee->status) == $employee_status->name)>
                                                        {{ $employee_status->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Type</label>
                                            <select class="form-select mb-2" name="type" data-control="select2"
                                                data-hide-search="false" data-placeholder="Select Employee Type" required>
                                                <option></option>
                                                @foreach (getDynamicValues('employee_type') as $k => $employee_type)
                                                    <option value="{{ $employee_type->name }}"
                                                        @selected(old('type', $employee->type) == $employee_type->name)>
                                                        {{ $employee_type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type')
                                                <div class="fv-plugins-message-container invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-10 fv-row">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="form-label">Official Email</label>
                                            <input type="text" class="form-control mb-2" name="official_email"
                                                value="{{ old('official_email', $employee->official_email) }}" autocomplete="off"
                                                placeholder="example@mail.com" />
                                        </div>
                                        @error('official_email')
                                            <div class="fv-plugins-message-container invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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

    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-800px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('assignOffDays') }}">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Crop Image Before Upload</h1>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <div class="img-container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="" id="sample_image" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="button" id="crop" class="btn btn-primary">
                                <span class="indicator-label">Crop</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endSection

@section('script')
    <script src="{{ asset('assets/custom/dopzone.js.css') }}"></script>
    <script src="{{ asset('assets/custom/cropper.js') }}"></script>
    <script>
        var imageUrl = '';
        $(document).ready(function() {
            $('#removeImageSpan').show();
        });
        $(document).on('click', '#removeImageSpan', function() {
            $(this).hide();
            imageUrl = $('#uploaded_image').data('image');
        });
        $(document).on('click', '#cancelImageSpan', function() {
            $(this).hide();
            $('#removeImageSpan').show();
            $('#uploaded_image').css('background-image', 'url(' + imageUrl + ')');
        });
        $(document).on('click', '#changeImageIcon', function() {
            imageUrl = $('#uploaded_image').data('image');
            $('#cancelImageSpan').show();
            $('#removeImageSpan').hide();
        })

        $(function() {
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

        var $modal = $('#modal');
        var image = document.getElementById('sample_image');
        var cropper;

        $('#upload_image').change(function(event) {
            var files = event.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });

            canvas.toBlob(function(blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#uploaded_image').css('background-image', 'url(' + base64data + ')');
                    $('#base64').val(base64data);
                    $modal.modal('hide');
                    $('#removeImage').val('');
                }
            });
        });
    </script>
@endsection
