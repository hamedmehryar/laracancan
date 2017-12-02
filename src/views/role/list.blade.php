@extends('laracancan::master.master')
@section('content')
    @include('laracancan::master.error_list')
            <div class="row">
                <div class="col-md-6">
                    <h2>Roles</h2>
                </div>
                <div class="col-md-6">
                    <button href="#" id="add_role_btn" class="btn btn-danger bottom_buttons notext large"><i class="fa fa-plus"></i></button>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb" class="pull-right">
                      <li class="active"><i class="fa fa-user"></i>&nbsp;Roles</li>
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
                                 <li role="presentation" class="active"><a href="#active" data-toggle="tab">All({{$roles->count()}})</a></li>
                             </ul>
                             <!--end-->
                             <div class="tab-content">
                                 <!--first tab content-->
                                 <div class="tab-pane active" id="active">
                                     <table class="table table-striped table-hover">
                                         <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Name</th>
                                             <th>Display Name</th>
                                             <th>Description</th>
                                             <th>Action</th>
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
                                                             <li><a class="edit_role" role-id="{{$role->id}}"><i class="fa fa-edit"></i> Edit</a></li>
                                                             <li><a class="manage_role_permissions" role-id="{{$role->id}}"><i class="fa fa-key"></i> Manage Permissions</a></li>
                                                             <li><a class="delete_role" role-id="{{$role->id}}" href="#" ><i class="fa fa-trash-o"></i> Delete</a></li>
                                                             <form action="{{ route('lccrole.destroy', ['id' => $role->id]) }}" method="delete" id="{{ 'delete_role_'.$role->id }}">
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
    <script src="{{ asset('hamedmehryar/laracancan/jquery.confirm-master/jquery.confirm.min.js') }}"></script>
    <script>
        $('#add_role_btn').click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccrole/create')}}", "modal-content", true);
        });

        $(".edit_role").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccrole')}}/"+$(this).attr('role-id')+"/edit", "modal-content", true);
        });

        $(".manage_role_permissions").click(function(){
            showModalUntilAjaxResponse("general_modal");
            getContentWithAjax("{{url('lccrole')}}/"+$(this).attr('role-id')+"/manage_role_permissions", "modal-content", true);
        });

        $(".delete_role").confirm({
            text: "Are You Sure You Want To Delete This Item?",
            title: "Confirmation Required",
            confirm: function(button) {
                $('#delete_role_'+$(button).attr('role-id')).submit();
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