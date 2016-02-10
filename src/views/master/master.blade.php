<!DOCTYPE html>
<html lang="en">
<head>
    <?php $user = \Illuminate\Support\Facades\Auth::user()?>
    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo csrf_token() ?>"/>
    <title>LaraCanCan</title>
    <link rel="shortcut icon" href="{{asset('hamedmehryar/laracancan/images/logo.png')}}" />
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/sb-admin/fontawesome/css/font-awesome.min.css') }}">

    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/sb-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/sb-admin/css/sb-admin.css') }}">

    <!-- DATATABLES-->
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/datatables-colvis/css/dataTables.colVis.css') }}">
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/datatable-bootstrap/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('hamedmehryar/laracancan/css/dataTables.responsive.css')}}">


    <!-- jQuery UI CSS -->
    <link href="{{ asset('hamedmehryar/laracancan/jquery-ui-1.11.4.custom/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('hamedmehryar/laracancan/jquery.tablesorter/themes/blue/style.css') }}" rel="stylesheet">
    <link href="{{asset('hamedmehryar/laracancan/css/pace.css')}}" rel="stylesheet">
    <link href="{{asset('hamedmehryar/laracancan/bootstrap-multi-select/css/bootstrap-multiselect.css') }}" rel="stylesheet">
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
                        <img src="{{asset('hamedmehryar/laracancan/images/logo.png')}}">
                        LaraCanCan
                    </div>
                    <div class="brand-logo-collapsed">
                        <img src="{{asset('hamedmehryar/laracancan/images/logo.png')}}" alt="App Logo" class="img-responsive">
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
                <!-- END Left navbar-->
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
                @include('laracancan::master.resources_sidebar')
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
            <div class="pull-left"><i class="fa fa-copyright"></i>LaraCanCan 2016</div>
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
<!-- JQUERY-->
<script src="{{ asset('hamedmehryar/laracancan/js/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/jquery-ui-1.11.4.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('js/jquery.form.min.js') }}"></script>
<!-- DATATABLES-->
<script src="{{ asset('hamedmehryar/laracancan/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/datatable-bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/datatable-bootstrap/js/dataTables.bootstrapPagination.js') }}"></script>
<script src="{{ asset('hamedmehryar/laracancan/js/dataTables.responsive.js')}}"></script>
<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('hamedmehryar/laracancan/js/app.js') }}"></script>
<script src="{{ asset('jquery.tablesorter/jquery.tablesorter.js') }}"></script>

<script src="{{ asset('dashboards/vendor/moment/min/moment-with-locales.min.js') }}"></script>
<script src="{{ asset('dashboards/vendor/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('courseCoordinator/js/custom.js') }}"></script>

<script src="{{ asset('notification/js/notification.js') }}"></script>
<script src="{{ asset('messages/message.js') }}"></script>
<script src="{{ asset('dashboards/js/pace.min.js')}}"></script>
<script src="{{ asset('jquery.confirm-master/jquery.confirm.min.js') }}"></script>
<script>
    @if($user->lang != "en")
        $(function(){
            $('.toggle-calendar').trigger('click');
        });
        $(document).ajaxComplete(function(){
            $('.toggle-calendar').trigger('click');
        });
    @endif
</script>
<script>
    <?php

    $NotificationSoundNO=1;
    $ifNotificationSoundAllowed=true;

     if(\Illuminate\Support\Facades\DB::table('notification_settings')->where('user_id',$user->id)->where('resource','notification_sound')->exists()){

        $NotificationSoundNO=\Illuminate\Support\Facades\DB::table('notification_settings')->where('user_id',$user->id)->where('resource','notification_sound')->first()->record_id;

     }

     if(\Illuminate\Support\Facades\DB::table('notification_settings')->where('user_id',$user->id)->where('resource','notification_play_sound')->exists()){

        if(!(\Illuminate\Support\Facades\DB::table('notification_settings')->where('user_id',$user->id)->where('resource','notification_play_sound')->first()->allowed)){
            $ifNotificationSoundAllowed=false;
        }

     }


    ?>
    NotificationSound=new Audio('/sounds/'+"<?php echo $NotificationSoundNO ?>"+'.mp3');
    ifNotificationSoundAllowed="<?php echo $ifNotificationSoundAllowed ?>";
//    isFirstNotification=true;
    function PlayNotificationSound(){
//        if(ifNotificationSoundAllowed && !(isFirstNotification)){
        if(ifNotificationSoundAllowed){
            NotificationSound.play();
        }
    }
</script>
@yield('page_specific_scripts')
<ul class="chat-row">
</ul>
</body>

</html>