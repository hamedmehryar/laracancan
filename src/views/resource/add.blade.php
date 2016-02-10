<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add New Resource</h4>
</div>
<div class="modal-body">

    {!! Form::open(['route' => 'lcc.resource.store']) !!}
        <div class="form-group">
        <label>Name<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
        <label>Display Name English<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_en', null, ['class' => 'form-control']) !!}
        </div>
    <div class="form-group">
        <label>Display Name Persian<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_pr', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>Display Name Pashto<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('display_name_pa', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>DB Table<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('table_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>Model Name<span style="color:red; margin-left:2px;" >*</span></label>
        {!! Form::text('model_name', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>FontAwesome Icon</label>
        {!! Form::text('icon_class', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label>Show In Side Menu</label>
        {!! Form::radio('in_sidemenu', "1", true ) !!}&nbsp;Yes
        {!! Form::radio('in_sidemenu', "0",false ) !!}&nbsp;No
    </div>
    <div class="form-group">
        <label>Reportable</label>
        {!! Form::radio('is_reportable', "1", true ) !!}&nbsp;Yes
        {!! Form::radio('is_reportable', "0",false ) !!}&nbsp;No
    </div>

    <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    {!! Form::close() !!}
    <br><br><br>


</div>

