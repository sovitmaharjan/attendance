<select class="form-select mb-2" id="assignedDays" name="days[]"
        data-control="select2"
        data-hide-search="false" data-placeholder="Select Days"
        required multiple>
    <option></option>
    @foreach(getDays() as $day)
        <option
            value="{{$day}}" @selected(in_array($day, (array)getDays()))>{{$day}}</option>
    @endforeach
</select>

