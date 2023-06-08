<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/categories.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/nepali.datepicker.v4.0.1.min.js') }}"></script>

<script>
    var hierarchyBranchDepartment = [];
    var hierarchyBranchEmployee = [];
    var hierarchyDepartmentEmployee = [];

    function message(field) {
        return $(
            '<div class="fv-plugins-message-container invalid-feedback"><div data-fiedivld="name"-validator="notEmpty">The ' +
            field + ' feild is required</div></div>');
    }
    
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toastr-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "0",
        "hideDuration": "0",
        "timeOut": "0",
        "extendedTimeOut": "0",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

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
</script>

@include('partials.datepicker')
@include('partials.timepicker')
@include('partials.validation')
@include('partials.session-message')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#basic-datatable").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    })

    $(document).on("click", ".delete", function() {
        event.preventDefault();
        var id = $(this).data("id");
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete this record. This process cannot be undone.",
            icon: "warning",
            buttonsStyling: false,
            showCancelButton: true,
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger"
            }
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $("#delete-form-" + id).submit();
            }
        })
    });
</script>
@yield('script')
