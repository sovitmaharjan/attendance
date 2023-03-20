<label class="required form-label">Branch</label>
<select class="form-select mb-2" id="branch" name="branch" data-control="select2" data-hide-search="false"
    data-placeholder="Select Branch" required>
    <option></option>
    @foreach ($branch as $item)
        <option value="{{ $item->id }}" @selected(old('branch') == $item->id)>
            {{ $item->name }}</option>
    @endforeach
</select>
