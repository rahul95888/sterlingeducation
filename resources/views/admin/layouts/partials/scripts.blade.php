<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toaster/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert2/sweet-alert.init.js') }}"></script>
<script src="{{ asset('assets/plugins/parsley/parsley.min.js') }}"></script>

<!-- Toaster JS -->
<!-- Toaster JS -->
<!-- select2 css -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- select2 css -->
<!--app JS-->
<script src="{{ asset('assets/js/app.js') }}"></script>
    <script>

        // only number and float value //
        function isFloat(evt) {
            var charCode = (event.which) ? event.which : event.keyCode;
            if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {

                return false;
            } else {
                //if dot sign entered more than once then don't allow to enter dot sign again. 46 is the code for dot sign
                let parts = evt.srcElement.value.split('.');
                if (parts.length > 1 && charCode == 46) {
                    return false;
                }
                return true;

            }
        }
    </script>
@include('admin.layouts.partials.flash-message')
