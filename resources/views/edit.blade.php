@extends ('mainLayout')

@section ('main')
<main id="js-page-content" role="main" class="page-content mt-3">
  <div class="subheader">
    <h1 class="subheader-title">
      <i class='subheader-icon fal fa-plus-circle'></i> Редактировать
    </h1>

  </div>
  <form action="/edit_handler" method="post">
    {{csrf_field()}}
    <div class="row">
      <div class="col-xl-6">
        <div id="panel-1" class="panel">
          <div class="panel-container">
            <div class="panel-hdr">
              <h2>Общая информация</h2>
            </div>
            <div class="panel-content">

                <input type="hidden" id="simpleinput"  class="form-control" name="id" value="{{$user->id}}">

                <!-- username -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Имя</label>
                <input type="text" id="simpleinput"  class="form-control" name="username" value="{{$user->username}}">
              </div>

            <!-- company -->
            <div class="form-group">
                <label class="form-label" for="simpleinput">Место работы</label>
                <input type="text" id="simpleinput" class="form-control" name="company" value="{{$user->company}}">
            </div>

              <!-- job -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Должность</label>
                <input type="text" id="simpleinput" class="form-control" name="job" value="{{$user->job}}">
              </div>

              <!-- phone -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Номер телефона</label>
                <input type="text" id="simpleinput" class="form-control" name="phone" value="{{$user->phone}}">
              </div>

              <!-- address -->
              <div class="form-group">
                <label class="form-label" for="simpleinput">Адрес</label>
                <input type="text" id="simpleinput" class="form-control" name="address" value="{{$user->address}}">
              </div>

              <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                <button class="btn btn-warning">Редактировать</button>
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
