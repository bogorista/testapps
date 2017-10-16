var elixir = require('laravel-elixir');

elixir(function(mix) {
    mix.styles([
        './assets/blueline/css/bootstrap.min.css',
        './assets/blueline/css/plugins/jquery-ui-1.10.3.custom.min.css',
        './assets/blueline/css/plugins/colorpicker.css',
        './assets/blueline/css/plugins/jquery-slider.css',
        './assets/blueline/css/plugins/summernote.css',
        './assets/blueline/css/plugins/chosen.css',
        './assets/blueline/css/plugins/datatables.min.css',
        './assets/blueline/css/plugins/nprogress.css',
        './assets/blueline/css/plugins/jquery-labelauty.css',
        './assets/blueline/css/plugins/easy-pie-chart-style.css',
        './assets/blueline/css/plugins/fullcalendar.css',
        './assets/blueline/css/plugins/reflex.min.css',
        './assets/blueline/css/plugins/animate.css',
        './assets/blueline/css/plugins/flatpickr.dark.min.css',
        './assets/blueline/css/ionicons.min.css',
        './assets/blueline/css/plugins/bootstrap-editable.css',
        './assets/blueline/css/plugins/jquery.ganttView.css',
        './assets/blueline/css/plugins/dropzone.min.css',
        './assets/blueline/css/plugins/lightbox.min.css',
        './assets/blueline/css/dripicons.css',

        './assets/blueline/css/blueline.css'

    ], 'assets/blueline/css/app.css')
    .scripts([
        './assets/blueline/js/bootstrap.min.js', 
        './assets/blueline/js/plugins/jquery-ui-1.10.3.custom.min.js',
        './assets/blueline/js/plugins/bootstrap-colorpicker.min.js',
        './assets/blueline/js/plugins/jquery.knob.min.js',
        './assets/blueline/js/plugins/summernote.min.js',
        './assets/blueline/js/plugins/chosen.jquery.min.js',
        './assets/blueline/js/plugins/datatables.min.js',
        './assets/blueline/js/plugins/jquery.nanoscroller.min.js',
        './assets/blueline/js/plugins/jqBootstrapValidation.js',
        './assets/blueline/js/plugins/nprogress.js',
        './assets/blueline/js/plugins/jquery-labelauty.js',
        './assets/blueline/js/plugins/validator.min.js',
        './assets/blueline/js/plugins/timer.jquery.min.js',
        './assets/blueline/js/plugins/jquery.easypiechart.min.js',
        './assets/blueline/js/plugins/velocity.min.js',
        './assets/blueline/js/plugins/velocity.ui.min.js',
        './assets/blueline/js/plugins/moment-with-locales.min.js',
        './assets/blueline/js/plugins/chart.min.js',
        './assets/blueline/js/plugins/countUp.min.js',
        './assets/blueline/js/plugins/jquery.inputmask.bundle.min.js',
        './assets/blueline/js/plugins/fullcalendar/fullcalendar.min.js',
        './assets/blueline/js/plugins/fullcalendar/gcal.js',
        './assets/blueline/js/plugins/fullcalendar/lang-all.js',
        './assets/blueline/js/plugins/jquery.ganttView.js',
        './assets/blueline/js/plugins/dropzone.js',
        './assets/blueline/js/plugins/flatpickr.min.js',
        './assets/blueline/js/plugins/bootstrap-editable.min.js',
        './assets/blueline/js/plugins/blazy.min.js',
        './assets/blueline/js/plugins/autogrow.min.js',
        './assets/blueline/js/plugins/lightbox.min.js',

        './assets/blueline/js/blueline.js',

    ],  'assets/blueline/js/app.js');
});
