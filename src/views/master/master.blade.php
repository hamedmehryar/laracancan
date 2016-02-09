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
    <link rel="stylesheet" href="{{ asset('dashboards/vendor/fontawesome/css/font-awesome.min.css') }}">
    <!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="{{ asset('dashboards/vendor/simple-line-icons/css/simple-line-icons.css') }}">
    <!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="{{ asset('dashboards/vendor/animate.css/animate.min.css')  }}">
    <!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="{{ asset('dashboards/vendor/whirl/dist/whirl.css')  }}">
    <!-- =============== PAGE VENDOR STYLES ===============-->

    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('dashboards/css/bootstrap.css') }}" id="bscss">

                <!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="{{ asset('dashboards/css/app.css')  }}" id="maincss">

    <!-- DATATABLES-->
    <link rel="stylesheet" href=" {{ asset('dashboards/vendor/datatables-colvis/css/dataTables.colVis.css') }}">
    <link rel="stylesheet" href=" {{ asset('dashboards/vendor/datatable-bootstrap/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboards/css/dataTables.responsive.css')}}">


    <!-- jQuery UI CSS -->
    <link href="{{ asset('jquery-ui-1.11.4.custom/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->

    <link href="{{ asset('dashboards/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-toggle-master/css/bootstrap-toggle.css') }}" rel="stylesheet">



    <!-- Custom CSS -->
    <link href="{{asset('masterTrainer/css/app.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('masterTrainer/css/jquery.multiselect.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('dashboards/css/theme-promote.css') }}" rel="stylesheet">
    @if($user->lang != 'en' && ($user->hasRole('applicant') || $user->hasRole('participant')))
        <link href="{{ asset('jquery.tablesorter/themes/blue/style_dr.css') }}" rel="stylesheet">
        <link href="{{ asset('notification/css/notification_pr.css') }}" rel="stylesheet">
        <link href="{{ asset('messages/messages-rtl.css') }}" rel="stylesheet">
        <link href="{{ asset('courseFacilitator/custom-rtl.css') }}" rel="stylesheet">
        <link href="{{asset('dashboards/css/pace-rtl.css')}}" rel="stylesheet">
    @else
        <link href="{{ asset('jquery.tablesorter/themes/blue/style.css') }}" rel="stylesheet">
        <link href="{{ asset('notification/css/notification.css') }}" rel="stylesheet">
        <link href="{{ asset('messages/messages.css') }}" rel="stylesheet">
        <link href="{{ asset('courseFacilitator/custom.css') }}" rel="stylesheet">
        <link href="{{asset('dashboards/css/pace.css')}}" rel="stylesheet">
    @endif
    <link href=" {{ asset('bootstrap-multi-select/css/bootstrap-multiselect.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboards/vendor/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboards/vendor/genie/genie.css') }}" rel="stylesheet">
    <link href="{{ asset('/silviomoreto-bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    @yield('page_specific_styles')

    <script> var userLang = "{{userLang()}}"</script>
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
                <a href="{{url('dashboard')}}" class="navbar-brand">
                    <div class="brand-logo" style="color: white;font-weight: bold;font-size: 22px; padding-top: 16px; padding-bottom: 16px;">
                        Promote WLD
                    </div>
                    <div class="brand-logo-collapsed">
                        <!-- <img src="{{ asset('main/img/promote-logo.png') }}" alt="App Logo" class="img-responsive"> -->
                    </div>
                </a>
            </div>
            <!-- END navbar header-->
            <!-- START Nav wrapper-->
            <div class="nav-wrapper">
                {!! Form::hidden('from[]','',['id' => 'from'])!!}
                {!! Form::hidden('notify_ids[]','',['id' => 'notify_ids'])!!}
                {!! Form::hidden('notify_types[]','',['id' => 'notify_types'])!!}
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
                <!-- START Right Navbar-->
                @if($user != null)
                <ul class="nav navbar-nav navbar-right">
                    <div id="sound"></div>
                    @include('templates.nav_forum')
                    @include('templates.nav_message_dropdown')
                    @include('templates.nav_notification_dropdown')
                    @include('templates.nav_chat_list_dropdown')
                    @include('templates.nav_profile_dropdown')
                </ul>
                @endif
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
    @include('user.chat_buddies')

    <section>
        <!-- Page content-->
        <div class="content-wrapper">
            @include('templates.flash')
            @include('errors.error_list')
            @yield('content')
        </div>
    </section>

    <footer>
        <span id="copyright">
            <div class="pull-left"><i class="fa fa-copyright"></i>Promote 2015</div>
        </span>
        <div class="dock" id="dock">
        </div>
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
<script src="{{ asset('dashboards/vendor/modernizr/modernizr.js') }}"></script>
<!-- JQUERY-->
<script src="{{ asset('dashboards/vendor/jquery/dist/jquery.js') }}"></script>

<script src="{{ asset('jquery-ui-1.11.4.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('dashboards/js/jquery.scrollTo.js') }}"></script>
<!-- BOOTSTRAP-->
<script src="{{ asset('dashboards/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<!-- STORAGE API-->
<script src="{{ asset('dashboards/vendor/jQuery-Storage-API/jquery.storageapi.js') }}"></script>
<!-- JQUERY EASING-->
<script src="{{ asset('dashboards/vendor/jquery.easing/js/jquery.easing.js') }}"></script>
<!-- ANIMO-->
<script src="{{ asset('dashboards/vendor/animo.js/animo.js') }}"></script>
<!-- LOCALIZE-->
<script src="{{ asset('dashboards/vendor/jquery-localize-i18n/dist/jquery.localize.js') }}"></script>

<script src="{{ asset('dashboards/vendor/genie/genie.js') }}"></script>
<script src="{{ asset('dashboards/vendor/genie/jquery.genie.js') }}"></script>
<script src="{{ asset('dashboards/vendor/jqdock/jquery.jqdock.js') }}"></script>

<!-- =============== PAGE VENDOR SCRIPTS ===============-->

<!-- Custom JS -->
<script src="{{asset('masterTrainer/js/app.js')}}"></script>
<script src="{{asset('masterTrainer/js/jquery.multiselect.js')}}"></script>
<!-- <script src="{{ asset('dashboards/js/custom.js') }}"></script> -->
<script src="{{ asset('js/jquery.form.min.js') }}"></script>

<!-- PARSLEY-->
<script src="{{ asset('dashboards/vendor/parsleyjs/dist/parsley.min.js') }} "></script>
<script src="{{ asset('js/responsive-tabs.js') }}"></script>

<!-- DATATABLES-->
<script src="{{ asset('dashboards/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboards/vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
<script src="{{ asset('dashboards/vendor/datatable-bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('dashboards/vendor/datatable-bootstrap/js/dataTables.bootstrapPagination.js') }}"></script>
<script src="{{ asset('dashboards/js/dataTables.responsive.js')}}"></script>
<script src="{{ asset('dashboards/js/demo/demo-datatable.js') }}"></script>
<script src="{{ asset('dashboards/vendor/bootstrap-wysiwyg/bootstrap-wysiwyg.js') }}"></script>
<script src="{{ asset('ifvisible/ifvisible.min.js') }}"></script>

<!-- =============== APP SCRIPTS ===============-->
<script src="{{ asset('dashboards/js/app.js') }}"></script>
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