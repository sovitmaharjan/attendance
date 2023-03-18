<script>
    var branches = @json($branch); 
    var departments = @json($department); 
    var employees = @json($employee);

    function resetSection() {
        $('#employee').empty().trigger('change');
        $.each(employees, function(i, e) {
            var option = new Option(e.full_name, e.id);
            $('#employee').append(option).trigger('change');
        });
        $('#employee').val(null).trigger('change');

        $('#department').empty().trigger('change');
        $.each(departments, function(i, e) {
            var option = new Option(e.name, e.id);
            $('#department').append(option).trigger('change');
        });
        $('#department').val(null).trigger('change');

        $('#branch').empty().trigger('change');
        $.each(branches, function(i, e) {
            var option = new Option(e.name, e.id);
            $('#branch').append(option).trigger('change');
        });
        $('#branch').val(null).trigger('change');
    }

    $(document).on('click', '#reset-selection', function() {
        resetSection();
        
        $('#employee_id').val(null);
    });

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
                    var option = new Option(e.full_name, e.id);
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
                    var option = new Option(e.full_name, e.id);
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

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this,
                args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function() {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    $(document).on('keyup', '#employee_id', delay(function() {
        var id = $(this).val();
        var url = "{{ route('ajax.employee.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(data) {
                $('#employee').val(data.id).trigger('change');
                $('#department').val(data.department_id).trigger('change');
                $('#branch').val(data.branch_id).trigger('change');
            },
            error: function() {
                toastr.error('No data');
                resetSection();
            }
        });
    }, 500));
</script>
