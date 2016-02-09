<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">@lang('permissions.add_new_permission')</h4>
 </div>
 <div class="modal-body">

    {!! Form::open(['route' => 'resourcepermission.store']) !!}
     {!! Form::hidden('resource_id', $resource->id)!!}
     <div class="form-group">
        <select name="permissions[]" multiple style="width: 100%;" size="20" id="permissions">
            <?php
                $myPermissions = $resource->resourcePermissions;
                $myPermissionsIds = array();
                foreach($myPermissions as $p){
                    $myPermissionsIds[] = $p->id;
                }
            ?>
            @foreach(\Hamedmehryar\Laracancan\Models\Permission::all() as $permission)
                @if(!in_array($permission->id,$myPermissionsIds))
                    <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                @endif
            @endforeach
        </select>
     </div>
     <hr>

     <div class="form-group pull-right">
        <button class="btn btn-success notext large" type="submit" style="display:inline;"><i class="fa fa-save"></i></button>
     </div>

     {!! Form::close() !!}

  </div>
  <br><br>
  {{-- <div class="modal-footer">
 </div> --}}

 <script type="text/javascript">
     $('#permissions').multiselect({ listWidth: 400 });
 </script>
