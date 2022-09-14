{{-- <div>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
</div>
<a href="{{ route('employee.index') }}">list</a>
<form method="post" action="{{ route('employee.store') }}">
    @csrf
    <label>prefix</label>
    <select name="prefix" required>
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Mrs.">Mrs.</option>
    </select>
    <br />
    <label>firstname</label>
    <input type="text" name="firstname" value="{{ old('firstname') }}" required>
    <br />
    <label>middlename</label>
    <input type="text" name="middlename" value="{{ old('middlename') }}">
    <br />
    <label>lastname</label>
    <input type="text" name="lastname" value="{{ old('lastname') }}" required>
    <br />
    <label>gender</label>
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <br />
    <label>relationship</label>
    <select name="relationship" required>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Divorced">Divorced</option>
    </select>
    <br />
    <label>dob</label>
    <input type="text" name="dob" value="{{ old('dob') }}" required>
    <br />
    <label>join date</label>
    <input type="text" name="join_date" value="{{ old('join_date') }}" required>
    <br />
    <label>email</label>
    <input type="text" name="email" value="{{ old('email') }}" required>
    <br />
    <label>company</label>
    <select name="company_id" required>
        @foreach ($company as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>branch</label>
    <select name="branch_id" required>
        @foreach ($branch as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>department</label>
    <select name="department_id" required>
        @foreach ($department as $item)
            <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <br />
    <label>login id</label>
    <input type="text" name="login_id" value="{{ old('login_id') }}" required>
    <br />
    <label>supervisor</label>
    <select name="supervisor" required>
        @foreach ($supervisor as $item)
            <option value="{{ $item->id }}">{{ $item->firstname . $item->middlename . $item->lastname }}</option>
        @endforeach
    </select>
    <br />
    <label>status</label>
    <select name="status" required>
        <option value="status1">status1</option>
        <option value="status2">status2</option>
    </select>
    <br />
    <label>type</label>
    <select name="type" required>
        <option value="type1">type1</option>
        <option value="type2">type2</option>
    </select>
    <br />
    <button type="submit">save</button>
</form> --}}

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
                            <a href="{{ route("dashboard") }}" class="text-muted text-hover-primary">Home</a>
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
                        <a href="{{ route("employee.index") }}"
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
                    <a href="{{ route("employee.create") }}" class="btn btn-sm btn-primary">Create</a>
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="brand_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('brand.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="required">Image</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <div class="image-input image-input-outline image-input-empty" data-kt-image-input="true"
                                    style="background-image: url({{ asset('assets/admin/media/svg/files/blank-image.svg') }})">
                                    <div class="image-input-wrapper w-200px h-200px bgi-position-center" style="background-size: 95%;"></div>
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" required/>
                                    </label>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Set the brand image. Only *.png, *.jpg and *.jpeg image files
                                    are accepted</div>
                                @error('image')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="image" data-validator="notEmpty">{{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2 class="required">Status</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px"
                                        id="kt_ecommerce_add_brand_status"></div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <select class="form-select mb-2" data-control="select2" name="status"
                                    data-hide-search="true" data-placeholder="Select an option"
                                    id="kt_ecommerce_add_brand_status_select" required>
                                    <option></option>
                                    <option value="1" selected="selected">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <div class="text-muted fs-7">Set the brand status.</div>
                                @error('status')
                                    <div class="fv-plugins-message-container invalid-feedback">
                                        <div data-field="status" data-validator="notEmpty">{{ $message }}</div>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row">
                                    <label class="required form-label">Brand Name</label>
                                    <input type="text" name="title" class="form-control mb-2" placeholder="Brand name"
                                        value="{{ old('title') }}" required/>
                                    <div class="text-muted fs-7">A brand name is required and recommended to be unique.
                                    </div>
                                    @error('title')
                                        <div class="fv-plugins-message-container invalid-feedback">
                                            <div data-field="title" data-validator="notEmpty">{{ $message }}</div>
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-10 fv-row">
                                    <label class="form-label">Description</label>
                                    <textarea name="description" class="form-control mb-2" id="description"
                                        rows="5">{{ old('description') }}</textarea>
                                    <div class="text-muted fs-7">Set a description to the brand.</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('brand.index') }}" id="kt_ecommerce_add_product_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="kt_ecommerce_add_brand_submit" class="btn btn-primary">
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
    <script src="{{ asset('assets/admin/js/custom/apps/ecommerce/catalog/save-brand.js') }}"></script>
@endSection
