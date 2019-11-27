@stack('before-scripts')
<!-- CoreUI and necessary plugins-->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/validator.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/common.js') }}"></script>
<script src="{{ asset('assets/plugins/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pace-progress/js/pace.min.js') }}"></script>
<script src="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/plugins/coreui/coreui/dist/js/coreui.min.js') }}"></script>
<!-- Plugins and scripts required by this view-->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}"></script>
@stack('scripts')