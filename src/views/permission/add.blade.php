<div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>
     <h4 class="modal-title">Add New Permission</h4>
</div>
 <div class="modal-body">
     <!-- search box starts here -->
      @include('errors.error_list')

    {!! Form::open(['route' => 'lcc.permission.store']) !!}
     <div class="form-group">
    <label>Name:<span style="color:red; margin-left:2px;" >*</span></label>
     {!! Form::text('name', null, ['class' => 'form-control']) !!}
      </div>

     <div class="form-group">
         <label>Display Name:<span style="color:red; margin-left:2px;" >*</span></label>
         {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
     </div>
     <div class="form-group">
     <label>Description:</label>
     {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      </div>

      <hr>

       <div class="form-group pull-right">
       <button class="btn btn-success notext large" type="submit" style="display:inline;"><i class="fa fa-save"></i></button>
     </div>
    {!! Form::close() !!}
     <br><br>

  </div>

