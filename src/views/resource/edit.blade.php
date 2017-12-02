<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Edit Permission</h4>
</div>
<div class="modal-body">

    <form action="{{ route('lccresource.update', ['id' => $resource->id]) }}" method="put" data-parsley-validate="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="form-group">
            <label>Name<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $resource->name }}" />
        </div>

        <div class="form-group">
            <label>Display Name English<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_en" class="form-control" value="{{ $resource->display_name_en }}" />
        </div>
        <div class="form-group">
            <label>Display Name Persian<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_pr" class="form-control" value="{{ $resource->display_name_pr }}" />
        </div>
        <div class="form-group">
            <label>Display Name Pashto<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name_pa" class="form-control" value="{{ $resource->display_name_pa }}" />
        </div>
        <div class="form-group">
            <label>DB Table<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="table_name" class="form-control" value="{{ $resource->table_name }}" />
        </div>
        <div class="form-group">
            <label>Model Name<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="model_name" class="form-control" value="{{ $resource->model_name }}" />
        </div>
        <div class="form-group">
            <label>FontAwesome Icon</label>
            <input type="text" name="icon_class" class="form-control" value="{{ $resource->icon_class }}" />
        </div>
        <div class="form-group">
            <label>Show In Side Menu</label>
            <input type="radio" name="in_sidemenu" value="1" {{ $resource->is_sidemenu == 1?"checked":"" }}/>&nbsp;Yes
            <input type="radio" name="in_sidemenu" value="0" {{ $resource->is_sidemenu == 0?"checked":"" }}/>&nbsp;No
        </div>
        <div class="form-group">
            <label>Reportable</label>
            <input type="radio" name="is_reportable" value="1" {{ $resource->is_reportable == 1?"checked":"" }}/>&nbsp;Yes
            <input type="radio" name="is_reportable" value="0" {{ $resource->is_reportable == 0?"checked":"" }}/>&nbsp;No

        </div>

        <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    </form>
    <br><br><br>


</div>

