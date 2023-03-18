<script>
    $(document).on('select2:select', '#branch', function() {
        var id = $(this).val();
        var url = "{{ route('ajax.branch.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(data) {
                $('#department').empty().trigger('change');
                $.each(data.departments, function(i, e) {
                    var option = new Option(e.name, e.id);
                    $('#department').append(option).trigger('change');
                });
                $('#department').val(null).trigger('change');

                $('#employee').empty().trigger('change');
                $.each(data.employees, function(i, e) {
                    var option = new Option(e.firstname, e.id);
                    $('#employee').append(option).trigger('change');
                });
                $('#employee').val(null).trigger('change');
                $('#employee_id').val(null);
            }
        });
    });

    $(document).on('select2:select', '#department', function() {
        var id = $(this).val();
        var url = "{{ route('ajax.department.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(data) {
                $('#branch').val(data.branch_id).trigger('change');
                $('#employee').empty().trigger('change');
                $.each(data.employees, function(i, e) {
                    var option = new Option(e.firstname, e.id);
                    $('#employee').append(option).trigger('change');
                });
                $('#employee').val(null).trigger('change');
                $('#employee_id').val(null);
            }
        });
    });

    $(document).on('select2:select', '#employee', function() {
        var id = $(this).val();
        var url = "{{ route('ajax.employee.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(data) {
                $('#branch').val(data.branch_id).trigger('change');
                $('#department').val(data.department_id).trigger('change');
                $('#employee_id').val(data.id);
            }
        });
    });
</script>