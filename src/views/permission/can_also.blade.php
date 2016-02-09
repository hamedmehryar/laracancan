<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">@lang('permissions.can_also_title', ['permission'=>'<label class="label label-default" style="color: #000000">'.$resourcePermission->permission->display_name.'</label>', 'resource'=>'<label class="label label-default" style="color: #000000">'.$resource->display_name_en.'</label>'])</h4>
 </div>
 <div class="modal-body">

    {!! Form::open(['route' => array('resourcepermission.postCanAlso', $resourcePermission->id)]) !!}
     <div class="form-group">
        <select name="resourcePermissions[]" multiple style="width: 100%;" size="20" id="resourcepermissions">
            @foreach($canAlsoes as $rp)
                @if(in_array($rp->id, $resourcePermission->childIds()))
                    <option value="{{$rp->id}}" selected="true">{{$rp->permission->display_name}}</option>
                @else
                    <option value="{{$rp->id}}">{{$rp->permission->display_name}}</option>
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
     $('#resourcepermissions').multiselect({ listWidth: 400 });
 </script>
