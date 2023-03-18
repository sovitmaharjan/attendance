<div class="fv-row w-100 flex-md-root">
    <label class="required form-label">Employee Id</label>
    <div class="d-flex">
        <input type="text" class="form-control" id="employee_id" name="employee_id" value="{{ old('employee_id', isset($dropdown->branch_id) ? $dropdown->branch_id : '') }}"
            required />
    </div>
</div>
