<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Edit Role</h4>
</div>

<div class="modal-body">

    <form action="{{ route('lccrole.update', ['id' => $role->id]) }}" method="put" data-parsley-validate="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="form-group">
            <label>Name:<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" required data-parsley-minlength="3"/>
        </div>

        <div class="form-group">
            <label>Display Name:<span style="color:red; margin-left:2px;" >*</span></label>
            <input type="text" name="display_name" value="{{ $role->display_name }}" class="form-control" required data-parsley-minlength="3"/>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $role->description }}</textarea>
        </div>

        <button class="btn btn-success bottom_buttons notext large" type="submit"><i class="fa fa-save"></i></button>
    </form>

    <br><br><br>
</div>