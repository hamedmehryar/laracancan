<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add New Permission</h4>
</div>
 <div class="modal-body">
     <form action="{{ route('lccpermission.store') }}" method="POST">
         <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
         <div class="form-group">
             <label>Name:<span style="color:red; margin-left:2px;" >*</span></label>
             <input type="text" name="name" class="form-control">
         </div>

         <div class="form-group">
             <label>Display Name:<span style="color:red; margin-left:2px;" >*</span></label>
             <input type="text" name="display_name" class="form-control">
         </div>
         <div class="form-group">
             <label>Description:</label>
             <textarea name="description" class="form-control"></textarea>
         </div>

         <hr>

         <div class="form-group pull-right">
             <button class="btn btn-success notext large" type="submit" style="display:inline;"><i class="fa fa-save"></i></button>
         </div>
     </form>
     <br><br>

  </div>

