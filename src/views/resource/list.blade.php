@extends('laracancan::master.master')
@section('content')
    @include('laracancan::master.error_list')
            <div class="row">
                <div class="col-md-6">
                    <h2>Resources</h2>
                </div>
                <div class="col-md-6">
                    <button href="#" id="add_resource_btn" class="btn btn-danger bottom_buttons notext large"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb" class="pull-right">
                      <li class="active"><i class="fa fa-database"></i>&nbsp;Resources</li>
                    </ol>
                </div>
            </div>

             <div class="row">
                 <div class="col-md-12">
                     <div class="panel panel-promote">
                         <!-- /.panel-heading -->
                         <div class="panel-body">
                                 <table class="table table-striped table-hover">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Name</th>
                                             <th>Display Name English</th>
                                             <th>Display Name Persian</th>
                                             <th>Display Name Pashto</th>
                                             <th>Action</th>

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
                                                         <li><a class="edit_resource" resource-id="{{$resource->id}}"><i class="fa fa-edit"></i>&nbsp;Edit</a></li>
                                                         <li><a class="manage_children" resource-id="{{$resource->id}}"><i class="fa fa-sitemap"></i>&nbsp;Manage Children</a></li>
                                                         <li><a class="delete_resource" resource-id="{{$resource->id}}" href="#" ><i class="fa fa-trash-o"></i>&nbsp;Delete</a></li>
                                                         <form action="{{ route('lccresource.destroy', ['id' => $resource->id]) }}" method="delete" id="{{ 'delete_resource_'.$resource->id }}">
                                                             <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                                                         </form>
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
    <script src="{{ asset('hamedmehryar/laracancan/jquery.confirm-master/jquery.confirm.min.js') }}"></script>
    <script>
        $('#add_resource_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccresource/create')}}", "modal-content", true);
        });

        $(".edit_resource").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccresource')}}/"+$(this).attr('resource-id')+"/edit", "modal-content", true);
        });

        $(".manage_children").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccresource')}}/"+$(this).attr('resource-id')+"/manage_children", "modal-content", true);
        });

        $(".delete_resource").confirm({
            text: "Are you sure you want to delete this item?",
            title: "Confirmation Required",
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
    <script>
        $(document).ready(function(){
            $('.table').dataTable();
        });
    </script>

@stop