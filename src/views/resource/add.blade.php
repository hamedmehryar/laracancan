<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">@lang('resources.add_new_resource')</h4>
</div>
<div class="modal-body">

    {!! Form::open(['route' => 'resource.store']) !!}
        <div class="form-group">
        <label>@lang('resources.name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        <label>@lang('resources.display_name_en')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_en', null, ['class' => 'form-control']) !!}
        </div>
    <div class="form-group">
        <label>@lang('resources.display_name_dr')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_pr', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('resources.display_name_pa')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_pa', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('resources.table_name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('table_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('resources.model_name')<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('model_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('resources.icon_class')</label>
        {!! Form::text('icon_class', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>@lang('resources.side_menue')</label>
        {!! Form::radio('in_sidemenu', "1", true ) !!}&nbsp;Yes
        {!! Form::radio('in_sidemenu', "0",false ) !!}&nbsp;No
    </div>
    <div class="form-group">
        <label>@lang('resources.is_reportable')</label>
        {!! Form::radio('is_reportable', "1", true ) !!}&nbsp;Yes
        {!! Form::radio('is_reportable', "0",false ) !!}&nbsp;No
    </div>

    <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    {!! Form::close() !!}
    <br><br><br>


</div>

