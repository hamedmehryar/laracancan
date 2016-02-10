<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>LaraCanCan</title>
    <link rel="shortcut icon" href="{{asset('hamedmehryar/laracancan/img/logo.png')}}" />
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/vendor/fontawesome/css/font-awesome.min.css') }}">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/vendor/animate.css/animate.min.css')  }}">
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/vendor/whirl/dist/whirl.css')  }}">
    <!-- =============== PAGE VENDOR STYLES ===============-->

    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/css/bootstrap.css') }}" id="bscss">

                <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/css/app.css')  }}" id="maincss">

    <!-- DATATABLES-->
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/vendor/datatables-colvis/css/dataTables.colVis.css') }}">
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/css/dataTables.responsive.css')}}">


    <!-- jQuery UI CSS -->
    <link href="{{ asset('hamedmehryar/laracancan/jquery-ui-1.11.4.custom/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{ asset('hamedmehryar/laracancan/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('hamedmehryar/laracancan/bootstrap-toggle-master/css/bootstrap-toggle.css') }}" rel="stylesheet">

    <link href="{{ asset('hamedmehryar/laracancan/css/theme-promote.css') }}" rel="stylesheet">
    <link href="{{ asset('hamedmehryar/laracancan/jquery.tablesorter/themes/blue/style.css') }}" rel="stylesheet">
    <link href="{{asset('hamedmehryar/laracancan/css/pace.css')}}" rel="stylesheet">
    <link href=" {{ asset('hamedmehryar/laracancan/bootstrap-multi-select/css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('hamedmehryar/laracancan/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('hamedmehryar/laracancan/vendor/genie/genie.css') }}" rel="stylesheet">
    @yield('page_specific_styles')
</head>

<body>
<div class="wrapper">
    <div id="page-overlay"></div>
    <!-- top navbar-->
    <header class="topnavbar-wrapper" style="position:static">
        <!-- START Top Navbar-->
        <nav role="navigation" class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header">
                <a href="#" class="navbar-brand">
                    <div class="brand-logo" style="color: white;font-weight: bold;font-size: 22px; padding-top: 16px; padding-bottom: 16px;">
                        LaraCanCan
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="{{ asset('hamedmehryar/laracancan/img/logo.png') }}" alt="App Logo" class="img-responsive">
                    </div>
                </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
                <!-- START Left navbar-->
                <ul class="nav navbar-nav">
                    <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a href="#" data-toggle-state="aside-collapsed" class="hidden-xs">
                            <em class="fa fa-navicon"  data-toggle="tooltip" title="Side Bar" data-placement="bottom"></em>
                        </a>
                        <!-- Button to show/hide the sidebar on mobile. Visible on mobile only.-->
                        <a href="#" data-toggle-state="aside-toggled" data-no-persist="true" class="visible-xs sidebar-toggle">
                            <em class="fa fa-navicon"  data-toggle="tooltip" title="Side Bar" data-placement="bottom"></em>
                        </a>
                    </li>
                </ul>
                <!-- END Right Navbar-->
            </div>
            <!-- END Nav wrapper-->
        </nav>
        <!-- END Top Navbar-->
    </header>

    <!-- sidebar-->
    <aside class="aside">
        <!-- START Sidebar (left)-->
        <div class="aside-inner">
            <nav class="sidebar">
                @include('templates.resources_sidebar')
            </nav>
        </div>
        <!-- END Sidebar (left)-->
    </aside>

    <section>
        <!-- Page content-->
        <div class="content-wrapper">
            @include('templates.flash')
            @yield('content')
        </div>
    </section>

    <footer>
        <span id="copyright">
            <div class="pull-left"><i class="fa fa-copyright"></i>LaraCanCan 2015</div>
        </span>
    </footer>

</div>
<!-- general modal starts here -->
<div id="general_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- modal ends here -->
<div id="timeoutOops" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Oops!</h4>
            </div>
            <div class="modal-body">
                <p id="info">Your internet connection might be too slow or you might be disconnected. Please contact your service provider.</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="no" class="btn btn-success notext large"  data-dismiss="modal"><i class="fa fa-check"></i></button>
            </div>
        </div>
    </div>
</div>

@yield('modals')

<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/modernizr/modernizr.js') }}"></script>
<!-- JQUERY-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/jquery/dist/jquery.js') }}"></script>

<script src="{{ asset('hamedmehryar/laracancan/jquery-ui-1.11.4.custom/jquery-ui.min.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- JQUERY EASING-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<!-- ANIMO-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/animo.js/animo.js') }}"></script>
<!-- LOCALIZE-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/jquery-localize-i18n/dist/jquery.localize.js') }}"></script>

<script src="{{ asset('hamedmehryar/laracancan/vendor/genie/genie.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/genie/jquery.genie.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/jqdock/jquery.jqdock.js') }}"></script>

<!-- =============== PAGE VENDOR SCRIPTS ===============-->

<script src="{{ asset('hamedmehryar/laracancan/js/jquery.form.min.js') }}"></script>

<!-- PARSLEY-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/parsleyjs/dist/parsley.min.js') }} "></script>
<script src="{{ asset('hamedmehryar/laracancan/js/responsive-tabs.js') }}"></script>

<!-- DATATABLES-->
<script src="{{ asset('hamedmehryar/laracancan/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/js/dataTables.bootstrapPagination.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/js/dataTables.responsive.js')}}"></script>
<script src="{{ asset('hamedmehryar/laracancan/js/demo/demo-datatable.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/ifvisible/ifvisible.min.js') }}"></script>

<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('hamedmehryar/laracancan/js/app.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/jquery.tablesorter/jquery.tablesorter.js') }}"></script>

<script src="{{ asset('hamedmehryar/laracancan/vendor/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/js/pace.min.js')}}"></script>
<script src="{{ asset('hamedmehryar/laracancan/jquery.confirm-master/jquery.confirm.min.js') }}"></script>
@yield('page_specific_scripts')
</body>

</html>