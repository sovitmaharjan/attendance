<script>
    var branches, departments, employees;
</script>
@isset($branch)
    <script>
        var branches = @json($branch);
    </script>
@endisset
@isset($department)
    <script>
        var departments = @json($department);
    </script>
@endisset
@isset($employee)
    <script>
        var employees = @json($employee);
    </script>
@endisset
<script>
    function resetSection() {
        if ($('#employee') != 0) {
            $('#employee').empty().trigger('change');
            $.each(employees, function(i, e) {
                var option = new Option(e.full_name, e.id);
                $('#employee').append(option).trigger('change');
            });
            $('#employee').val(null).trigger('change');
        }

        if ($('#department') != 0) {
            $('#department').empty().trigger('change');
            $.each(departments, function(i, e) {
                var option = new Option(e.name, e.id);
                $('#department').append(option).trigger('change');
            });
            $('#department').val(null).trigger('change');
        }

        if ($('#branch') != 0) {
            $('#branch').empty().trigger('change');
            $.each(branches, function(i, e) {
                var option = new Option(e.name, e.id);
                $('#branch').append(option).trigger('change');
            });
            $('#branch').val(null).trigger('change');
        }
    }

    $(document).on('click', '#reset-selection', function() {
        resetSection();
        if ($('#employee_id') != 0) {
            $('#employee_id').val(null);
        }
    });

    $(document).on('select2:select', '#branch', function() {
        var id = $(this).val();
        var url = "{{ route('api.branch.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(response) {
                response = response.data;
                hierarchyBranchDepartment = response.departments;
                hierarchyBranchEmployee = response.employees;
                if ($('#department') != 0) {
                    $('#department').empty().trigger('change');
                    $.each(response.departments, function(i, e) {
                        var option = new Option(e.name, e.id);
                        $('#department').append(option).trigger('change');
                    });
                    $('#department').val(null).trigger('change');
                }

                if ($('#employee') != 0) {
                    $('#employee').empty().trigger('change');
                    $.each(response.employees, function(i, e) {
                        var option = new Option(e.full_name, e.id);
                        $('#employee').append(option).trigger('change');
                    });
                    $('#employee').val(null).trigger('change');
                }
                if ($('#employee_id') != 0) {
                    $('#employee_id').val(null);
                }
            }
        });
    });

    $(document).on('select2:select', '#department', function() {
        var id = $(this).val();
        var url = "{{ route('api.department.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(response) {
                response = response.data;
                hierarchyDepartmentEmployee = response.employees;
                if ($('#branch') != 0) {
                    $('#branch').val(response.branch_id).trigger('change');
                }
                if ($('#employee') != 0) {
                    $('#employee').empty().trigger('change');
                    $.each(response.employees, function(i, e) {
                        var option = new Option(e.full_name, e.id);
                        $('#employee').append(option).trigger('change');
                    });
                    $('#employee').val(null).trigger('change');
                }
                if ($('#employee_id') != 0) {
                    $('#employee_id').val(null);
                }
            }
        });
    });

    $(document).on('select2:select', '#employee', function() {
        var id = $(this).val();
        var url = "{{ route('api.employee.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            method: 'GET',
            url: url,
            success: function(response) {
                response = response.data;
                if ($('#branch') != 0) {
                    $('#branch').val(response.branch_id).trigger('change');
                }
                if ($('#department') != 0) {
                    $('#department').val(response.department_id).trigger('change');
                }
                if ($('#employee_id') != 0) {
                    $('#employee_id').val(response.id);
                }
            }
        });
    });

    $(document).on('keyup', '#employee_id', delay(function() {
        var id = $(this).val();
        if (id > 0) {
            var url = "{{ route('api.employee.show', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                method: 'GET',
                url: url,
                success: function(response) {
                    response = response.data;
                    resetSection();
                    if ($('#employee') != 0) {
                        $('#employee').val(response.id).trigger('change');
                    }
                    if ($('#department') != 0) {
                        $('#department').val(response.department_id).trigger('change');
                    }
                    if ($('#branch') != 0) {
                        $('#branch').val(response.branch_id).trigger('change');
                    }
                },
                error: function() {
                    toastr.error('', 'Employee not found');
                    resetSection();
                }
            });
        }
    }, 500));
</script>
