@extends('Dashboard.master')
@section('page_specific_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- DATATABLES-->
    <link rel="stylesheet" href=" {{ asset('dashboards/vendor/datatables-colvis/css/dataTables.colVis.css') }}">
    <link rel="stylesheet" href=" {{ asset('dashboards/vendor/datatable-bootstrap/css/dataTables.bootstrap.css') }}">
    <style>
        li.training_grid {
            display: -moz-inline-stack;
            display: inline-block;
            *display: inline;
        }

    </style>
@stop
@section('content')
            <div class="row">
                <div class="col-md-6">
                    <h2>{{$resource['display_name_en']}}</h2>
                </div>
                <div class="col-md-6">
                    <button href="#" id="add_role_btn" class="btn btn-danger bottom_buttons notext large"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb" class="pull-right">
                      <li class="active"><i class="fa fa-{{$resource->icon_class}}"></i>&nbsp;{{$resource['display_name_en']}}</li>
                    </ol>
                </div>
            </div>
             <div class="row">
                 <div class="col-md-12">
                     <div class="panel panel-promote">
                         <!-- /.panel-heading -->
                         <div class="panel-body">
                             <!--nav tabs-->
                             <ul class="nav nav-tabs nav-justified">
                                 <li role="presentation" class="active"><a href="#active" data-toggle="tab">@lang('alerts.all')({{$roles->count()}})</a></li>
                                 @if(Laracancan::can('trash', 'role'))
                                 <li role="presentation"><a href="#trashed" data-toggle="tab">@lang('alerts.trashed')({{$trashed_roles->count()}})</a></li>
                                 @endif
                             </ul>
                             <!--end-->

                             <div class="tab-content">
                                 <!--first tab content-->
                                 <div class="tab-pane active" id="active">
                                     <table class="table table-striped table-hover tablesorter">
                                         <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>@lang('roles.name')</th>
                                             <th>@lang('roles.display_name')</th>
                                             <th>@lang('roles.description')</th>
                                             <th>@lang('roles.action')</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         <?php $i =1; ?>
                                         @foreach($roles as $role)
                                             <tr class="gradeA">
                                                 <td>{{$i++}}</td>
                                                 <td>{{$role->name}}</td>
                                                 <td>{{$role->display_name}}</td>
                                                 <td>{{str_limit($role->description, 50)}}</td>
                                                 <td align="center">

                                                     <div class="btn-group">
                                                         <button type="button" class="btn btn-xs btn-primary dropdown-toggle notext small" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-tasks"></span>
                                                         </button>
                                                         <ul class="dropdown-menu pull-right">
                                                             <li><a class="edit_role" role-id="{{$role->id}}"><i class="fa fa-edit"></i>@lang('roles.edit')</a></li>
                                                             <li><a class="manage_role_permissions" role-id="{{$role->id}}"><i class="fa fa-key"></i>@lang('roles.manage_permissions')</a></li>
                                                             @if(Laracancan::can('trash', 'role'))
                                                             <li><a href="javascript:void(0)" id="{{$role->id}}" class="trash_role"><i class="fa fa-trash"></i> @lang('alerts.trash_item')</a></li>
                                                             @endif
                                                         </ul>
                                                     </div>
                                                     {{--<a class="label label-danger delete_role" role-id="{{$role->id}}" href="#" ><i class="fa fa-trash-o"></i></a>--}}
                                                     {{--{!!Form::open(array('route' => array('role.destroy', $role->id), 'method' => 'delete', 'id'=>'delete_role_'.$role->id))!!}--}}
                                                     {{--{!!Form::close()!!}--}}
                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                                 <!--end-->

                                 <!--second tab content-->
                                 <div class="tab-pane" id="trashed">
                                     <table class="table table-striped table-hover tablesorter">
                                         <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>@lang('roles.name')</th>
                                             <th>@lang('roles.display_name')</th>
                                             <th>@lang('roles.description')</th>
                                             <th>@lang('roles.action')</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         <?php $i =1; ?>
                                         @foreach($trashed_roles as $role)
                                             <tr class="gradeA">
                                                 <td>{{$i++}}</td>
                                                 <td>{{$role->name}}</td>
                                                 <td>{{$role->display_name}}</td>
                                                 <td>{{str_limit($role->description, 50)}}</td>
                                                 <td align="center">
                                                     <div class="btn-group">
                                                         <button type="button" class="btn btn-xs btn-primary dropdown-toggle notext small" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-tasks"></span>
                                                         </button>
                                                         <ul class="dropdown-menu pull-right">
                                                             @if(Laracancan::can('trash', 'role'))
                                                             <li><a href="javascript:void(0)" id="{{$role->id}}" class="restore_role"><i class="fa fa-reply"></i> @lang('alerts.restore_item')</a></li>
                                                             @endif
                                                             @if(Laracancan::canDelete( 'role'))
                                                             <li><a href="javascript:void(0)" id="{{$role->id}}" class="delete_role"><i class="fa fa-trash"></i> @lang('alerts.delete_item')</a></li>
                                                             @endif
                                                         </ul>
                                                     </div>
                                                 </td>
                                             </tr>
                                         @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                                 <!--end-->
                             </div>
                         </div>
                         <!-- /.panel-body -->
                     </div>
                 </div>
             </div>
            <!-- /.col-lg-12 -->
@stop
@section('page_specific_scripts')
    <script src="{{ asset('jquery.confirm-master/jquery.confirm.min.js') }}"></script>
    <script>
        $('#add_role_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/role/create", "modal-content", true);
        });

        $(".edit_role").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/role/"+$(this).attr('role-id')+"/edit", "modal-content", true);
        });

        $(".manage_role_permissions").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/role/"+$(this).attr('role-id')+"/manage_role_permissions", "modal-content", true);
        });

        @if(Laracancan::can('trash', 'role'))
        $(".trash_role").confirm({
            text: "@lang('alerts.trash_confirmation')",
            title: "@lang('alerts.confirmation_title')",
            confirm: function(button) {
                var id = $(button).attr('id');
                var url = "role/trash/"+id;
                $('.trash_role').attr('href', url);
                window.location = $('.trash_role').attr('href');
            },
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "",
            cancelButton: "",
            post: true,
            confirmButtonClass: "btn-success notext large fa fa-check",
            cancelButtonClass: "btn-danger notext large fa fa-close",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
        });
        @endif

        @if(Laracancan::canDelete( 'role'))
        $(".delete_role").confirm({
            text: "@lang('alerts.delete_confirmation')",
            title: "@lang('alerts.confirmation_title')",
            confirm: function(button) {
                var id = $(button).attr('id');
                var url = "role/delete/"+id;
                $('.delete_role').attr('href', url);
                window.location = $('.delete_role').attr('href');
            },
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "",
            cancelButton: "",
            post: true,
            confirmButtonClass: "btn-success notext large fa fa-check",
            cancelButtonClass: "btn-danger notext large fa fa-close",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
        });
        @endif

        @if(Laracancan::can('trash', 'role'))
        $(".restore_role").confirm({
            text: "@lang('alerts.restore_confirmation')",
            title: "@lang('alerts.confirmation_title')",
            confirm: function(button) {
                var id = $(button).attr('id');
                var url = "role/restore/"+id;
                $('.restore_role').attr('href', url);
                window.location = $('.restore_role').attr('href');
            },
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "",
            cancelButton: "",
            post: true,
            confirmButtonClass: "btn-success notext large fa fa-check",
            cancelButtonClass: "btn-danger notext large fa fa-close",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
        });
        @endif

    </script>

    <!-- Custom JS -->
    <script src="{{ asset('dashboards/js/custom.js') }}"></script>
    <!-- DATATABLES-->
    <script src="{{ asset('dashboards/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboards/vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script src="{{ asset('dashboards/vendor/datatable-bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('dashboards/vendor/datatable-bootstrap/js/dataTables.bootstrapPagination.js') }}"></script>
    <script src="{{ asset('dashboards/js/demo/demo-datatable.js') }}"></script>
    <script src="{{ asset('jquery.tablesorter/jquery.tablesorter.min.js') }}"></script>
    <script>
        if($('table') != null)
            $('table').tablesorter();
        $(document).ready(function(){
            $('.table').dataTable();
        });
    </script>
@stop