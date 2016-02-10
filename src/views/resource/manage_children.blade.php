<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Resource <label class="label label-default" style="color: #000000">{{$resource->display_name_en}}</label>: Manage Children</h4>
</div>
 <div class="modal-body">
    {!! Form::open(['route' => array('lcc.resource.postManageChildren', $resource->id)]) !!}
     <div class="row">
         <div class="col-md-12">
             <div class="row">
                 <div class="col-md-6">
                     <strong>
                         Related Resources
                     </strong>
                 </div>
                 <div class="col-md-6">
                     <strong>
                         Pivot table name for Many2Many relationships
                     </strong>
                 </div>
             </div>
             <hr style="margin-top: 0px;margin-bottom: 0px;">
             @foreach(\Hamedmehryar\Laracancan\Models\Resource::where('id', '!=', $resource->id)->get() as $r)
                 <div class="row">
                     <div class="col-md-6">
                         {!!Form::checkbox( 'children[]', $r->id ,$r->isChildOf($resource->id),['id'=>'resource'.$r->id, 'class'=>'resourcecheckbox', 'data-resource-id'=> $r->id] )!!}<label for="{{'resource'.$r->id}}">&nbsp;{{$r->display_name_en}}</label>
                     </div>
                     <div class="col-md-6">
                         @if($r->isParentOf($resource->id))
                             <?php
                                 $pivot = "";
                                 if(DB::table('lcc_resourcerelations')->where('resource_id',$resource->id)->where('child_id', $r->id)->exists())
                                     $pivot = DB::table('lcc_resourcerelations')->where('resource_id',$resource->id)->where('child_id', $r->id)->first()->pivot;
                             ?>
                             {!!Form::text($r->id.'_pivot', $pivot, ['id'=>$r->id.'_pivot', 'class'=>'pivotname form-control', 'style'=>$r->isChildOf($resource->id)?'block':'display:none'])!!}
                         @endif
                     </div>
                 </div>
                 <hr style="margin-top: 0px;margin-bottom: 0px;">
             @endforeach
         </div>
     </div>
     <hr>

     <div class="form-group pull-right">
        <button class="btn btn-success notext large" type="submit"><i class="fa fa-save"></i></button>
     </div>

     {!! Form::close() !!}
 </div>
<script>
    $('.resourcecheckbox').change(function(){
        var checked = $(this).is(':checked');
        if(checked){
            $('#'+$(this).data('resource-id')+'_pivot').show();
            $('#'+$(this).data('resource-id')+'_pivot').focus();
        }else{
            $('#'+$(this).data('resource-id')+'_pivot').hide();
        }
    });
</script>
<br><br>
