<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add New Resource</h4>
</div>
<div class="modal-body">

    <form action="{{ route('lccresource.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="form-group">
            <label>Name<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="name" class="form-control" />
        </div>

        <div class="form-group">
            <label>Display Name English<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_en" class="form-control" />
        </div>
        <div class="form-group">
            <label>Display Name Persian<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_pr" class="form-control" />
        </div>
        <div class="form-group">
            <label>Display Name Pashto<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_pa" class="form-control" />
        </div>
        <div class="form-group">
            <label>DB Table<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="table_name" class="form-control" />
        </div>
        <div class="form-group">
            <label>Model Name<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="model_name" class="form-control" />
        </div>
        <div class="form-group">
            <label>FontAwesome Icon</label>
            <input type="text" name="icon_class" class="form-control" />
        </div>
        <div class="form-group">
            <label>Show In Side Menu</label>
            <input type="radio" name="in_sidemenu" value="1" checked/>&nbsp;Yes
            <input type="radio" name="in_sidemenu" value="0"/>&nbsp;No
        </div>
        <div class="form-group">
            <label>Reportable</label>
            <input type="radio" name="is_reportable" value="1" checked/>&nbsp;Yes
            <input type="radio" name="is_reportable" value="0"/>&nbsp;No
        </div>

        <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    </form>
    <br><br><br>


</div>

