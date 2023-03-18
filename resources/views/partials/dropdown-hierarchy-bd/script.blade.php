<script>
    var branches = @json($branch); 
    var departments = @json($department); 

    function resetSection() {
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
            }
        });
    });
</script>
