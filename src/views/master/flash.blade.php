@if (Session::has('flash_success'))

    <div id="success_message" class="alert alert-success">{{ Session::get('flash_success') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>

@endif

@if(Session::has('flash_error'))
    <div id="error_message" class="alert alert-danger" role="alert">{{ Session::get('flash_error') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
@endif

@if(Session::has('flash_warn'))
    <div id="warn_message" class="alert alert-warning" role="alert">{{ Session::get('flash_warn') }}
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
@endif