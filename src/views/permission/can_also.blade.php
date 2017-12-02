<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">{{"Permission ".$resourcePermission->permission->display_name." On ".$resource->display_name_en." Can Also:"}}</h4>
 </div>
 <div class="modal-body">
     <form action="{{ route('lccresourcepermission.postCanAlso', ['id' => $resourcePermission->id]) }}" method="post">
         <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
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
     </form>
  </div>
  <br><br>
  {{-- <div class="modal-footer">
 </div> --}}

 <script type="text/javascript">
     $('#resourcepermissions').multiselect({ listWidth: 400 });
 </script>
