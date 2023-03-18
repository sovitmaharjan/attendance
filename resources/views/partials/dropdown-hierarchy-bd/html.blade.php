<div class="mb-10 fv-row">
    <div class="d-flex flex-wrap gap-5">
        <div class="fv-row w-100 flex-md-root">
            <label class="required form-label">Branch</label>
            <div class="d-flex">
                <select class="form-select" id="branch" name="branch" data-control="select2" data-hide-search="false" data-placeholder="Select Branch" required>
                    <option></option>
                    @foreach ($branch as $item)
                    <option value="{{ $item->id }}" @selected(old('branch', ($dropdown ? $dropdown->branch_id : ''))==$item->id)>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="fv-row w-100 flex-md-root">
            <label class="required form-label">Department</label>
            <div class="d-flex">
                <select class="form-select" id="department" name="department" data-control="select2" data-hide-search="false" data-placeholder="Select Department" required>
                    <option></option>
                    @foreach ($department as $item)
                    <option value="{{ $item->id }}" @selected(old('department', ($dropdown ? $dropdown->department_id : ''))==$item->id)>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="fv-row">
            <div class="col-md-1">
                <button type="button" id="reset-selection" class="btn btn-sm btn-light-danger mt-3 mt-md-9" data-bs-toggle="tooltip" data-bs-placement="top" title="reset dropdown">
                    <i class="la la-sync fs-3"></i></button>
            </div>
        </div>
    </div>
</div>