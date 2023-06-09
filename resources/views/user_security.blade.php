@extends ('mainLayout')

@section('permission')
    @php
        use Illuminate\Support\Facades\Auth;
        if (!(Auth::user()->id===$user->id || Auth::user()->hasRole('admin'))){
           header("Location: /");
           die();
        }
    @endphp
@endsection

@section ('main')
<main id="js-page-content" role="main" class="page-content mt-3">
  <div class="subheader">
    <h1 class="subheader-title">
      <i class='subheader-icon fal fa-lock'></i> Безопасность
    </h1>
  </div>

    @if($errors->any())
        <div class="alert alert-danger text-dark" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  <form action="/security_handler" method="post">
    {{csrf_field()}}
    <div class="row">
      <div class="col-xl-6">
        <div id="panel-1" class="panel">
          <div class="panel-container">
            <div class="panel-hdr">
              <h2>Обновление эл. адреса и пароля</h2>
            </div>
            <div class="panel-content">

            <input type="hidden" id="simpleinput"  class="form-control" name="id" value="{{$user->id}}">

            <!-- email -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Email</label>
                <input type="text" id="simpleinput" class="form-control" name="email" value="{{$user->email}}">
              </div>

              <!-- password -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Пароль</label>
                <input type="password" id="simpleinput" name="password" class="form-control">
              </div>

              <!-- password confirmation-->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Подтверждение пароля</label>
                <input type="password" id="simpleinput" name="password_confirmation" class="form-control">
              </div>


              <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                <button class="btn btn-warning">Изменить</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</main>
@endsection

@section ('js')
<script src="/js/vendors.bundle.js"></script>
<script src="/js/app.bundle.js"></script>
<script>
  $(document).ready(function() {

    $('input[type=radio][name=contactview]').change(function() {
      if (this.value == 'grid') {
        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
        $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
        $('#js-contacts .js-expand-btn').addClass('d-none');
        $('#js-contacts .card-body + .card-body').addClass('show');

      } else if (this.value == 'table') {
        $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
        $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
        $('#js-contacts .js-expand-btn').removeClass('d-none');
        $('#js-contacts .card-body + .card-body').removeClass('show');
      }

    });

    //initialize filter
    initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
  });
</script>
@endsection
