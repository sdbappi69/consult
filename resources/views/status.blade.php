<!-- error/success messages -->
@if (count($errors))
    <div class="alert alert-danger alert-with-border alert-dismissible alert-message" role="alert">
        <i class="fa fa-bell m-r-10"></i> {{ $errors->first() }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session()->has('successMsg'))
      <div class="alert alert-success alert-with-border alert-dismissible alert-message" role="alert">
            <i class="fa fa-check m-r-10"></i> {{ session()->get('successMsg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </button>
      </div>
@endif

@if(session()->has('errorMsg'))
      <div class="alert alert-danger alert-with-border alert-dismissible alert-message" role="alert">
            <i class="fa fa-bell m-r-10"></i> {{ session()->get('errorMsg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
            </button>
      </div>
@endif
<!-- END -->
