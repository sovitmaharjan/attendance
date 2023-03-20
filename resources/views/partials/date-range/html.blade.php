
<div class="mb-10 fv-row">
    <div class="d-flex flex-wrap gap-5">
        <div class="fv-row w-100 flex-md-root">
            <label class="required form-label">From</label>
            <div class="d-flex">
                <input type="text" class="form-control from_date" date-id="from"
                    placeholder="yyyy-dd-mm" id="from_date" name="from_date"
                    autocomplete="off" value="{{ old('from_date', (isset($date['from_date']) ? date('Y-m-d', strtotime($date['from_date'])) : '')) }}" required />
            </div>
        </div>
        <div class="fv-row w-100 flex-md-root">
            <label class="form-label">&nbsp;</label>
            <div class="d-flex">
                <input type="text" class="form-control nepali_from_date" id="nepali_from_date"
                    name="nepali_from_date" autocomplete="off"
                    value="{{ old('nepali_from_date', ($date['extra']['nepali_from_date'] ?? '')) }}" placeholder="yyyy-dd-mm" required />
            </div>
        </div>
        <div class="fv-row w-100 flex-md-root">
            <label class="required form-label">To</label>
            <div class="d-flex">
                <input type="text" autocomplete="off" class="form-control to_date"
                    value="{{ old('to_date', (isset($date['to_date']) ? date('Y-m-d', strtotime($date['to_date'])) : '')) }}" date-id="to" placeholder="yyyy-dd-mm"
                    id="to_date" name="to_date" required />
            </div>
        </div>
        <div class="fv-row w-100 flex-md-root">
            <label class="form-label">&nbsp;</label>
            <div class="d-flex">
                <input type="text" autocomplete="off" class="form-control nepali_to_date"
                    id="nepali_to_date" name="nepali_to_date" value="{{ old('nepali_to_date', ($date['extra']['nepali_to_date'] ?? '')) }}"
                    placeholder="yyyy-dd-mm" required />
            </div>
        </div>
    </div>
</div>