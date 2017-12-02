<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Permission</h4>
</div>

<div class="modal-body">

    <form action="{{ route('lccpermission.update', ['id' => $permission->id]) }}" method="put" data-parsley-validate="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="form-group">
            <label>Name:<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $permission->name }}" required data-parsley-minlength="3"/>
        </div>

        <div class="form-group">
            <label>Display Name<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name" class="form-control" value="{{ $permission->display_name }}" required data-parsley-minlength="3"/>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" value="{{ $permission->description }}"></textarea>
        </div>

        <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    </form>

    <br><br><br>
</div>