<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add New Permission</h4>
</div>
 <div class="modal-body">

    {!! Form::open(['url' => 'laracancan/role/'.$role->id.'/manage_role_permissions']) !!}
     <div class="row">
         <div class="col-md-6">
             <select name="resource_id" style="width: 100%;" size="20" id="resource_id">
                 @foreach(\Hamedmehryar\Laracancan\Models\Resource::all() as $resource)
                     <option value="{{$resource->id}}">{{$resource['display_name_en']}}</option>
                 @endforeach
             </select>
         </div>
         <div class="col-md-6">
             @foreach(\Hamedmehryar\Laracancan\Models\Resource::all() as $resource)
                 <select name="{{$resource->id}}_resourcepermissions[]" multiple style="width: 100%; display: none" size="20" id="resourcepermissions_{{$resource->id}}" class="resource-selects">
                     <?php
                        $roleResourcePermissions = $role->resourcePermissions;
                        $roleResourcePermissionsIds = array();
                        foreach($roleResourcePermissions as $p){
                            $roleResourcePermissionsIds[] = $p->id;
                        }
                     ?>
                     @foreach($resource->resourcePermissions as $permission)
                         <?php
                             $resourcePermission =  \Hamedmehryar\Laracancan\Models\Resourcepermission::where('permission_id',$permission->id)->where('resource_id', $resource->id)->where('parent_id', null)->first();
                             $parents = json_encode($resourcePermission->parentsIds());
                         ?>
                         {{$resourcePermission->id."<br>"}}

                             @if(in_array($resourcePermission->id, $roleResourcePermissionsIds))
                                <option class="resourcepermission-can-also" value="{{$permission->id}}" data-parents="{{$parents}}" selected>{{$permission->display_name}}</option>
                             @else
                                 <option class="resourcepermission-can-also" value="{{$permission->id}}" data-parents="{{$parents}}">{{$permission->display_name}}</option>
                             @endif
                     @endforeach
                 </select>
             @endforeach
         </div>
     </div>
     <hr>

     <div class="form-group pull-right">
        <button class="btn btn-success notext large" type="submit"><i class="fa fa-save"></i></button>
     </div>

     {!! Form::close() !!}
     <br><br>
 </div>
<script>
    $(document).ready(function(){
        $('#resource_id').click(function(){
            $('.resource-selects').hide();
            $('#resourcepermissions_'+$(this).val()).show();
        });
    });
</script>

