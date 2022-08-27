@extends('panel.layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <form role="form" action="{{route('user-create')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create User</b></h3>
              </div>
              <div class="card-body form-data-role">
                @include('panel.layouts.alert')
                @include('panel.layouts.validation')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Name <span class="text-danger">*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                    </div>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Mobile <span class="text-danger">*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="mobile" name="mobile" class="form-control" data-inputmask='"mask": "999-99999999"' data-mask>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Password <span class="text-danger">*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-unlock-alt"></i></span>
                                    </div>
                                    <input type="password" id="password" name="password" class="form-control">
                                </div>
                          </div>
                          <div class="form-group">
                            <label>Description <small>(Optional)</small></label>
                            <textarea class="form-control" rows="3" name="address" placeholder="Describe about the role ..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Email <span class="text-danger">*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" id="email" name="email" class="form-control">
                                </div>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control select2" id="is_active" name="is_active" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                  </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Confirm Password <span class="text-danger">*</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-unlock"></i></span>
                                    </div>
                                    <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                </div>
                                <small class='danger-text-password text-danger text-center' hidden>Password doesn't match!</small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Profile Image Upload</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Assign Permissions</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Permissions</label>
                        <select class="duallistbox" name="permissions[]" multiple="multiple">
                            @forelse ($permissions as $permission)
                                <option value="{{$permission->id}}">{{$permission->display_name}}</option>
                            @empty
                            No Permissions found!
                        @endforelse
                        </select>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Assign Roles</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label>Roles</label>
                        <select class="duallistboxroles" name="role" >
                            @forelse ($roles as $role)
                                <option value="{{$role->id}}">{{$role->display_name}}</option>
                            @empty
                            No Role found!
                        @endforelse
                        </select>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <input type="submit" class="btn btn-info" name="submit" value="Submit"/>
                <input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
@section('scripts')
  <script src="{{ asset('public/plugins/select2/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
  <script src="{{ asset('public/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('public/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.duallistboxroles').bootstrapDualListbox();
    $('[data-mask]').inputmask();
    $("input").on("blur",function(){
        if($(this).attr("name") == "name" && $(this).val().length <1) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(document).Toasts('create', {
                class: 'bg-danger', 
                title: 'Error',
                // subtitle: 'Exclusive Job Preparation',
                body: 'Name must not be empty!'
            });
        } else if ($(this).attr("name") == "email" && $(this).val().length <1) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(document).Toasts('create', {
                class: 'bg-danger', 
                title: 'Error',
                // subtitle: 'Exclusive Job Preparation',
                body: 'Email is in invalid format. Must not be empty or contains "@" !'
            });
        } else if ($(this).attr("name") == "mobile" && $(this).val().length <12 ) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(document).Toasts('create', {
                class: 'bg-danger', 
                title: 'Error',
                // subtitle: 'Exclusive Job Preparation',
                body: 'Mobile must not be empty !'
            });
        } else if ($(this).attr("name") == "password" && $(this).val().length <8 ) {
            $(this).removeClass('is-valid');
            $(this).addClass('is-invalid');
            $(document).Toasts('create', {
                class: 'bg-danger', 
                title: 'Error',
                // subtitle: 'Exclusive Job Preparation',
                body: 'Password must be 8 character long!'
            });
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
        }
    });
    $("#confirm_password").on("blur",function(){
        if($('#password').val() != $(this).val()) {
            $(this).addClass('is-invalid');
            $('#password').addClass('is-invalid');
            $(".danger-text-password").prop('hidden',false);
        } else {
            $(this).removeClass('is-invalid');
            $('#password').removeClass('is-invalid');
            $(".danger-text-password").prop('hidden',true);
        }
    });
    $("input[name=reset]").on("click",function(){
      $(".form-data-role").find("input").find("textarea").val('');
      $(".name").addClass('is-invalid');
    });
  </script>
@endsection