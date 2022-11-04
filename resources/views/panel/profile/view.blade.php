@extends('panel.layouts.app')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/atatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        @include('panel.layouts.alert')
        @include('panel.layouts.validation')
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="{{ $profile->userimages()->count() <= 0 ? asset('public/dist/img/icon.png'): asset($profile->userimages()->first()->image_path)}}"
                     alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{$profile->name}}</h3>

              <p class="text-muted text-center">{{$profile->roles()->first()->name}}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Notifications</b> <a class="float-right">1,322</a>
                </li>
                <li class="list-group-item">
                  <b>Messages</b> <a class="float-right">543</a>
                </li>
                <li class="list-group-item">
                  <b>Sets</b> <a class="float-right">13,287</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>See More</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Name</strong>

              <p class="text-muted">
                {{$profile->name}}
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Email</strong>

              <p class="text-muted">{{$profile->email}}</p>

              <hr>

              <strong><i class="fas fa-pencil-alt mr-1"></i> Address</strong>

              <p class="text-muted">
                {{$profile->address ?? 'N/A'}}
              </p>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="settings">
                  <form class="form-horizontal" method="post" action="{{route('profile-update',['id'=>$profile->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name" value="{{$profile->name}}" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputFile" class="col-sm-2 col-form-label">Profile Image Upload</label>
                        <div class="input-group col-sm-10">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email" value="{{$profile->email}}" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputName2" name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Address</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" name="address" placeholder="Address">
                            {{$profile->address}}
                        </textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" value="{{$profile->roles()->first()->name}}" disabled placeholder="Skills">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });
    function changeStatus(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, change it!'
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          url: "{{route('user-status-change',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              user_status = data.user_status == 1 ? 'deactivated': 'activated';
              if (user_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(8)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('tr[data-id='+id+'] td:nth-child(10)').html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i>Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(8)').html('<span class="badge badge-success badge-sm">Active</span>');
                $('tr[data-id='+id+'] td:nth-child(10)').html(`<button class="btn btn-warning btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-ban"></i>Deactivate</button>`);
              }
              if(status.status==200){
                Swal.fire(
                  'Status Changed!',
                  'Your selected role has been '+user_status+'.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection
