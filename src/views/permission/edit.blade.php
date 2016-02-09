<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">@lang('permissions.edit_permission')</h4>
</div>

<div class="modal-body">

    {!! Form::model($permission, array('route' => array('permission.update', $permission->id), 'method'=> 'put','data-parsley-validate'=> '')) !!}

     <div class="form-group">
        <label>@lang('permissions.name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'data-parsley-minlength'=>'3']) !!}
     </div>

     <div class="form-group">
         <label>@lang('permissions.display_name')<span style="color:red; margin-left:2px;" >*</span></label>
         {!! Form::text('display_name', null, ['class' => 'form-control', 'required' => 'required', 'data-parsley-minlength'=>'3']) !!}
     </div>

     <div class="form-group">
         <label>@lang('permissions.description')</label>
         {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
     </div>

    <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>

    {!! Form::close() !!}
    <br><br><br>
</div>