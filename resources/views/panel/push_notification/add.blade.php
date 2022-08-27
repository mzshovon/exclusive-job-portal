@extends('panel.layouts.app')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <form role="form" action="{{route('create-push-notification')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</b></h3>
              </div>
              <div class="card-body form-data-role">
                @include('panel.layouts.alert')
                @include('panel.layouts.validation')
                <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Subject <span class="text-danger">*</span></label>
                          <textarea class="form-control" rows="6" name="subject" placeholder="Describe about the section ..." style="width: 100%; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-4">
                            <label class="col-form-label" for="inputSuccess">Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                    </div>
                                    <input type="text" id="title" name="code" class="form-control" placeholder="Ex. BD-EXCLSV-SMS-12312">
                                </div>
                          </div>
                          <div class="col-md-4">
                            <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                  </select>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <label class="col-form-label" for="inputSuccess">Language <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control select2" id="language" name="language" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Language --</option>
                                    <option value="en">English</option>
                                    <option value="bn">Bangla</option>
                                  </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Duration:</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="text" class="form-control" name="token_used" value="{{$password}}" readonly>
                              </div>
                              <small>** Token is used from push notification storage **</small>
                            </div>
                            <div class="col-md-6">
                              <label>Duration:</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="number" class="form-control" name="duration" value="0">
                              </div>
                              <small>** Duration will be in days **</small>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <input type="submit" class="btn btn-info" name="submit" value="Submit"/>
                <input type="submit" class="btn btn-info" name="submit_and_send" value="Submit & Send"/>
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
  {{-- <script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
  <script src="{{ asset('public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
  {{-- <script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('public/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>v --}}

  <script>
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.duallistboxroles').bootstrapDualListbox();
    $('[data-mask]').inputmask();
    $(function () {
    // Summernote
    // $('.textarea').summernote();

    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
    })
  </script>
@endsection