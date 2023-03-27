<div class="fv-row w-100 flex-md-root">
    <label class="required form-label">Department</label>
    <div class="d-flex">
        <select class="form-select department" id="department" name="department" data-control="select2" data-hide-search="false"
            data-placeholder="Select Department" required>
            <option></option>
            @foreach ($department as $item)
                <option value="{{ $item->id }}" @selected(old('department', isset($dropdown['department_id']) ? $dropdown['department_id'] : '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
