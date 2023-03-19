<div class="fv-row w-100 flex-md-root">
    <label class="required form-label">Branch</label>
    <div class="d-flex">
        <select class="form-select" id="branch" name="branch" data-control="select2" data-hide-search="false"
            data-placeholder="Select Branch" required>
            <option></option>
            @foreach ($branch as $item)
                <option value="{{ $item->id }}" @selected(old('branch', isset($dropdown['branch_id']) ? $dropdown['branch_id'] : '') == $item->id)>
                    {{ $item->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
