<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">@lang('roles.add_new_role')</h4>
</div>
<div class="modal-body">
    <!-- search box starts here -->
    @include('errors.error_list')

    {!! Form::open(['route' => 'role.store']) !!}
    <div class="form-group">
        <label>@lang('roles.name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        <label>@lang('roles.display_name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('roles.description')</label>
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <hr>

    <div class="form-group pull-right">
        <button class="btn btn-success notext large" type="submit"><i class="fa fa-save"></i></button>
    </div>
    {!! Form::close() !!}
    <br><br>

</div>

