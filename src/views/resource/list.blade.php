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
                    <button href="#" id="add_resource_btn" class="btn btn-danger bottom_buttons notext large"><i class="fa fa-plus"></i></button>
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
                                 <table class="table table-striped table-hover tablesorter">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>@lang('resources.name')</th>
                                             <th>@lang('resources.display_name_en')</th>
                                             <th>@lang('resources.table_name')</th>
                                             <th>@lang('resources.model_name')</th>
                                             <th>@lang('resources.action')</th>

                                         </tr>
                                     </thead>
                                     <tbody>
                                     <?php $i =1; ?>
                                     @foreach($resources as $resource)
                                         <tr class="gradeA">
                                             <td>{{$i++}}</td>
                                             <td>{{$resource->name}}</td>
                                             <td>{{$resource->display_name_en}}</td>
                                             <td>{{$resource->table_name}}</td>
                                             <td>{{$resource->model_name}}</td>
                                             <td align="center">
                                                 <div class="btn-group">
                                                     <button type="button" class="btn btn-xs btn-primary dropdown-toggle notext small" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-tasks"></span>
                                                     </button>
                                                     <ul class="dropdown-menu pull-right">
                                                         <li><a class="edit_resource" resource-id="{{$resource->id}}"><i class="fa fa-edit"></i>&nbsp;@lang('resources.edit')</a></li>
                                                         <li><a class="manage_children" resource-id="{{$resource->id}}"><i class="fa fa-sitemap"></i>&nbsp;@lang('resources.manage_children')</a></li>
                                                         <li><a class="delete_resource" resource-id="{{$resource->id}}" href="#" ><i class="fa fa-trash-o"></i>&nbsp;@lang('resources.delete')</a></li>
                                                         {!!Form::open(array('route' => array('resource.destroy', $resource->id), 'method' => 'delete', 'id'=>'delete_resource_'.$resource->id))!!}
                                                         {!!Form::close()!!}
                                                     </ul>
                                                 </div>

                                             </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
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
        $('#add_resource_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/resource/create", "modal-content", true);
        });

        $(".edit_resource").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/resource/"+$(this).attr('resource-id')+"/edit", "modal-content", true);
        });

        $(".manage_children").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("/resource/"+$(this).attr('resource-id')+"/manage_children", "modal-content", true);
        });

        $(".delete_resource").confirm({
            text: "@lang('resources.delete_resource_message')",
            title: "@lang('resources.confirmation_required')",
            confirm: function(button) {
                $('#delete_resource_'+$(button).attr('resource-id')).submit();
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