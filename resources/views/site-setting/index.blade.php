@extends('layouts.app')
@section('company', 'active')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Company</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Company</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark">Create</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    {{-- @can('add-company') --}}
                        <a href="{{ route('company.index') }}" class="btn btn-sm btn-primary">Create</a>
                    {{-- @endcan --}}
                </div>
            </div>
        </div>
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form id="company_form" class="form d-flex flex-column flex-lg-row" method="POST"
                    action="{{ route('company.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <span class="mt-1 fs-7 text-danger">Fields with asterisk<span class="required"></span> are
                                    required </span>
                            </div>
                            <div class="card-body pt-0">
                                @foreach ($keys as $key => $value)
                                    @if ($value['visible'] == 1)
                                        <div class="mb-10 fv-row">
                                            <div class="d-flex flex-wrap gap-5">
                                                <div class="fv-row w-100 flex-md-root">
                                                    <label
                                                        class="{{ $key == 'company_name' || $key == 'company_code' ? 'required' : '' }} form-label">{{ $value['display_text'] }}</label>
                                                    @if ($value['element'] == 'image')
                                                        <div class="card card-flush py-4">
                                                            <div class="card-body text-center pt-0">
                                                                <div class="image-input image-input-empty image-input-outline mb-3"
                                                                    data-kt-image-input="true"
                                                                    style="background-image: url(assets/media/svg/files/blank-image.svg)">
                                                                    @if ($image = $site_settings->where('key', $key)->first())
                                                                        <div class="image-input-wrapper w-200px h-200px bgi-position-center"
                                                                            style="background-size: 95%; {{ $image->getFirstMediaUrl() ? 'background-image: url(' . $image->getFirstMediaUrl() . ')' : '' }}"
                                                                            id="uploaded_image"></div>
                                                                    @else
                                                                        <div class="image-input-wrapper w-200px h-200px bgi-position-center"
                                                                            style="background-size: 95%;"></div>
                                                                    @endif
                                                                    <label
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                        data-kt-image-input-action="change"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Change {{ $key }}">
                                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                                        <input type="file" name="{{ $key }}"
                                                                            accept=".png, .jpg, .jpeg" />
                                                                        <input type="hidden"
                                                                            name="{{ $key }}_remove" />
                                                                    </label>
                                                                    <span
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                        data-kt-image-input-action="cancel"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Cancel {{ $key }}">
                                                                        <i class="bi bi-x fs-2"></i>
                                                                    </span>
                                                                    <span
                                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                        data-kt-image-input-action="remove"
                                                                        data-bs-toggle="tooltip"
                                                                        title="Remove {{ $key }}">
                                                                        <i class="bi bi-x fs-2"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="d-flex">
                                                            <input type="text" class="form-control mb-2"
                                                                id="{{ $key }}" name="{{ $key }}"
                                                                value="{{ old($key, $site_settings->where('key', $key)->first()['value'] ?? '') }}"
                                                                placeholder="{{ $value['display_text'] }}"
                                                                autocomplete="off"
                                                                {{ $key == 'company_name' || $key == 'company_code' ? 'required' : '' }} />
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('company.index') }}" id="company_cancel"
                                class="btn btn-light me-5">Cancel</a>
                            <button type="submit" id="company_submit" class="btn btn-primary">
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
        $(document).ready(function() {
            $('#company_name').on('keyup', function() {
                var code = $(this).val().toUpperCase();
                if (code.length > 4) {
                    code = code.substring(0, 4);
                }
                $('#company_code').val(code);
            });

            $('#company_code').on('keyup', function() {
                var code = $(this).val().toUpperCase();
                if (code.length > 4) {
                    code = code.substring(0, 4);
                }
                $(this).val(code);
            });
        });
    </script>
@endsection
