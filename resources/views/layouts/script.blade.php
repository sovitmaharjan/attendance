<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/ecommerce/catalog/categories.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/nepali-datepicker.min.js') }}"></script>


<script>
    const {
        log: myLog
    } = console;
    // $(function () {
    //     var mainInput = document.getElementsByClassName("nepaliDatePicker");
    //     mainInput.nepaliDatePicker({
    //         language: "english",
    //         onChange: function () {
    //             let nepalidate = $(".nepaliDatePicker").val();
    //             let dateObj = NepaliFunctions.ParseDate(nepalidate);
    //             let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
    //             let year = engDate.year;
    //             let month = NepaliFunctions.Get2DigitNo(engDate.month);
    //             let day = NepaliFunctions.Get2DigitNo(engDate.day);
    //             let engValue = year+'-'+month+'-'+day;
    //             $(".datetime").val(engValue);
    //         },
    //         ndpYear: true,
    //         ndpMonth: true,
    //         ndpYearCount: 200
    //     });
    // });

    // dark and light mode
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        myLog(document.documentElement.getAttribute('data-theme-mode'))
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }


    function nepaliPicker(nep_class) {
        var main_input = document.getElementsByClassName(nep_class);
        main_input.nepaliDatePicker({
            language: "english",
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    }
    
    function neptoeng(nep_class, id_name) {
        console.log('hi');
        var mainInput = document.getElementsByClassName(nep_class);
        mainInput.nepaliDatePicker({
            language: "english",
            onChange: function() {
                let nepalidate = $("." + nep_class).val();
                let dateObj = NepaliFunctions.ParseDate(nepalidate);
                let engDate = NepaliFunctions.BS2AD(dateObj.parsedDate);
                let year = engDate.year;
                let month = NepaliFunctions.Get2DigitNo(engDate.month);
                let day = NepaliFunctions.Get2DigitNo(engDate.day);
                let engValue = year + '-' + month + '-' + day;
                $("#" + id_name).val(engValue);
            },
            ndpYear: true,
            ndpMonth: true,
            ndpYearCount: 200
        });
    }

    function getFormattedDate(dateStr) {
        var parts = dateStr.split('-');
        return new Date(parts[2], parts[1] - 1, parts[0]);
    }

    function reformatdate(datestr) {
        var parts = datestr.split('-');
        return parts[2] + '-' + parts[1] + '-' + parts[0];
    }

    function engtonep(this_date, idName) {
        let dateTime = $(this_date).val();
        if (dateTime) {
            let dateObj = new Date(dateTime);
            let year = dateObj.getUTCFullYear();
            let month = dateObj.getUTCMonth() + 1;
            let day = dateObj.getUTCDate(); // + 1 for 'dd-mm-yyyy'
            let nepaliDate = NepaliFunctions.AD2BS({
                year: year,
                month: month,
                day: day
            });
            let nepaliYear = nepaliDate.year;
            let nepaliMonth = ("0" + nepaliDate.month).slice(-2);
            let nepaliDay = ("0" + nepaliDate.day).slice(-2);
            let nepaliValue = nepaliYear + '-' + nepaliMonth + '-' + nepaliDay;
            $("#" + idName).val(nepaliValue);
        } else {
            $("#" + idName).val('');
        }
    }
</script>
<script>
    $(document).ready(function() {
        $(".timepicker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toastr-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
</script>
@if (Session::get('success'))
    <script>
        toastr.success('{{ Session::get('success') }}');
    </script>
@endif
@if (Session::get('info'))
    <script>
        toastr.info('{{ Session::get('info') }}');
    </script>
@endif
@if (Session::get('error'))
    <script>
        toastr.error('{{ Session::get('error') }}');
    </script>
@endif
@yield('script')
