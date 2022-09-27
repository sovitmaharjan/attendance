<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<select id="branch" name="branch">
    <option></option>
    @foreach ($branch as $item)
        <option value={{ $item->id }}>{{ $item->name }}</option>
    @endforeach
</select>
<br />
<select id="department" name="department">
    <option></option>
    @foreach ($department as $item)
        <option value={{ $item->id }}>{{ $item->name }}</option>
    @endforeach
</select>
<br />
<select id="employee" name="employee">
    <option></option>
    @foreach ($employee as $item)
        <option value={{ $item->id }}>
            {{ $item->firstname . ' ' . ($item->middlename ? $item->middlename . ' ' : '') . $item->lastname }}
        </option>
    @endforeach
</select>
<input type="text" id="id" name="id" />
<br />

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#branch').on('change', function() {
            console.log($(this).val());
        });

        $(document).on('change', '#employee', function(e) {
            e.preventDefault();
            var id = $(this).val();
            var url = "{{ route('api.employee.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    $('#branch').val(data.branch_id);
                    $('#department').val(data.department_id);
                    $('#id').val(data.id);
                }
            });
        });
    });
</script>
