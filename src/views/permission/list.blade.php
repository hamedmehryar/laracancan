@extends('laracancan::master.master')
@section('page_specific_styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- DATATABLES-->
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/vendor/datatables-colvis/css/dataTables.colVis.css') }}">
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/css/dataTables.bootstrap.css') }}">
    <link rel="stylesheet" href=" {{ asset('hamedmehryar/laracancan/silviomoreto-bootstrap-select/dist/css/bootstrap-select.css') }}">
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
                <div class="col-lg-12">
                    <h2>Permissions</h2>
                    <ol class="breadcrumb" class="pull-right">
                      <li class="active"><i class="fa fa-key"></i>&nbsp;Permissions</li>
                    </ol>
                </div>
            </div>

             <div class="row">
                 <div class="col-md-12">
                     <div class="panel panel-promote">
                         <!-- /.panel-heading -->
                         <div class="panel-body">
                             <select class="selectpicker" id="drop-nav">
                                 <option class="nav-link" value="all"><a  data-toggle="tab">All ({{\Hamedmehryar\Laracancan\Models\Permission::count()}})</a></option>
                                 @foreach($resources as $resource)
                                     <option class="nav-link" value="{{$resource->name}}"><a  data-toggle="tab">{{$resource['display_name_en']}} ({{$resource->resourcePermissions->count()}})</a></option>
                                 @endforeach
                             </select>
                             <div id="myTabContent" class="tab-content">
                                 <div class="tab-pane active in" id="all">
                                         <div class="row">
                                             <div class="col-md-12">
                                                 <button href="#" id="add_permission_btn" class="btn btn-danger bottom_buttons notext large"><i class="fa fa-plus"></i></button>
                                             </div>
                                         </div>
                                         <table class="table table-striped table-hover tablesorter">
                                             <thead>
                                                 <tr>
                                                     <th>#</th>
                                                     <th>Name</th>
                                                     <th>Description</th>
                                                     <th>Action</th>

                                                 </tr>
                                             </thead>
                                             <tbody>
                                             <?php $i =1; ?>
                                             @foreach(\Hamedmehryar\Laracancan\Models\Permission::all() as $permission)
                                                 <tr class="gradeA">
                                                     <td>{{$i++}}</td>
                                                     <td>{{$permission->display_name}}</td>
                                                     <td>{{$permission->description}}</td>
                                                     <td align="center">
                                                         <a class="label label-primary edit_permission" permission-id="{{$permission->id}}"><i class="fa fa-edit"></i></a>
                                                     </td>
                                                 </tr>
                                             @endforeach
                                             </tbody>
                                         </table>
                                 </div>
                                 @foreach($resources as $resource)
                                     <div class="tab-pane" id="{{$resource->name}}">
                                             <div class="row">
                                                 <div class="col-md-6">
                                                     <h3>{{$resource->display_name_en}}</h3>
                                                 </div>
                                                 <div class="col-md-6">
                                                     <button href="#" resource-id="{{$resource->id}}" class="btn btn-danger bottom_buttons add_resourcepermission_btn notext large"><i class="fa fa-plus"></i></button>
                                                 </div>
                                             </div>
                                             @if($resource->resourcePermissions->count() == 0)
                                                 <label class="label label-warning">No Permission Found</label>
                                             @else
                                                 <table class="table table-striped table-hover tablesorter">
                                                     <thead>
                                                     <tr>
                                                         <th>#</th>
                                                         <th>Name</th>
                                                         <th>Can Also</th>
                                                         <th>Action</th>

                                                     </tr>
                                                     </thead>
                                                     <tbody>
                                                     <?php $i =1; ?>
                                                     @foreach(\Hamedmehryar\Laracancan\Models\Resourcepermission::where('resource_id', $resource->id)->where('parent_id', null)->get() as $permission)
                                                         <tr class="gradeA">
                                                             <td>{{$i++}}</td>
                                                             <td>{{$permission->permission->display_name}}</td>
                                                             <td>
                                                                 @foreach($permission->childResourcePermissions as $child)
                                                                     <label class="label label-default" style="color: #000000">{{$child->permission->display_name}}</label>
                                                                 @endforeach
                                                             </td>
                                                             <td align="center">

                                                                 <div class="btn-group">
                                                                     <button type="button" class="btn btn-xs btn-primary dropdown-toggle notext small" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-tasks"></span>
                                                                     </button>
                                                                     <ul class="dropdown-menu pull-right">
                                                                         <li><a class="delete_resourcepermission" permission-id="{{$permission->permission->id}}" resource-id="{{$resource->id}}" href="#"><i class="fa fa-trash-o"></i>&nbsp;Delete</a></li>
                                                                         {!!Form::open(array('route' => array('lccresourcepermission.destroy', $permission->permission->id), 'method' => 'delete', 'id'=>'delete_resourcepermission_'.$resource->id.'_'.$permission->permission->id))!!}
                                                                         {!! Form::hidden('resource_id', $resource->id) !!}
                                                                         {!!Form::close()!!}
                                                                         <li><a class="can_also" permission-id="{{$permission->id}}"><i class="fa fa-sitemap"></i>Can Also..</a></li>
                                                                     </ul>
                                                                 </div>
                                                             </td>
                                                         </tr>
                                                     @endforeach
                                                     </tbody>
                                                 </table>
                                             @endif
                                     </div>
                                 @endforeach
                             </div>
                             <!-- /.table-responsive -->

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
        $('#add_permission_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("laracancan/permission/create", "modal-content", true);
        });

        $('.add_resourcepermission_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("laracancan/resourcepermission/create?resource_id="+$(this).attr('resource-id'), "modal-content", true);
        });

        $('.can_also').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("laracancan/resourcepermission/"+$(this).attr('permission-id')+"/can-also", "modal-content", true);
        });

        $(".edit_permission").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("laracancan/permission/"+$(this).attr('permission-id')+"/edit", "modal-content", true);
        });

        $(".delete_resourcepermission").confirm({
            text: "Are you sure you want to remove this permission?",
            title: "Confirmation Required",
            confirm: function(button) {
                $('#delete_resourcepermission_'+$(button).attr('resource-id')+'_'+$(button).attr('permission-id')).submit();
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
    </script>

    <!-- DATATABLES-->
    <script src="{{ asset('hamedmehryar/laracancan/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/vendor/datatables-colvis/js/dataTables.colVis.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/vendor/datatable-bootstrap/js/dataTables.bootstrapPagination.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/js/demo/demo-datatable.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/jquery.tablesorter/jquery.tablesorter.min.js') }}"></script>
    <script src="{{ asset('hamedmehryar/laracancan/silviomoreto-bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script>
        if($('table') != null)
            $('table').tablesorter();
        $(document).ready(function(){
            $('.table').dataTable();
        });
        $('.selectpicker').selectpicker({
            style: 'btn-primary',
            size: 10
        });
    </script>

@stop