    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>LogBook Magang UPT TIK</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Developed by <a href="#">.RAR</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('res/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('res/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('res/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('res/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('res/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ url('res/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('res/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('res/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('res/assets/js/main.js') }}"></script>

    <!-- J-Query -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session()->has('success'))
    <script>
        Swal.fire({
            title: "Success",
            text: "{{session()->get('success')}}",
            icon: "success"
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: "{{session()->get('error')}}",
            icon: "error"
        });
    </script>
    @endif