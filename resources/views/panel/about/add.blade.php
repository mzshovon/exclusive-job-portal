@extends('panel.layouts.app')
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <form role="form" action="{{route('about-create')}}" method="post" enctype="multipart/form-data">
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
                            <label class="col-form-label" for="inputSuccess">Title <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                    </div>
                                    <input type="text" id="title_bn" name="title_bn" class="form-control">
                                </div>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Banner Image Upload</label>
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
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></span></label>
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
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label" for="inputSuccess">Type <span class="text-danger">*</span></span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                            </div>
                            <select class="form-control select2" id="type" name="type" style="width: 100%;">
                                <option selected="selected" disabled>-- Select Type --</option>
                                <option value="1">About Us</option>
                                <option value="2">About Exam</option>
                                <option value="3">About Rule</option>
                              </select>
                        </div>
                      </div>
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Image Position <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control select2" id="image_position" name="image_position" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Position --</option>
                                    <option value="1">Top</option>
                                    <option value="2">Middle</option>
                                    <option value="3">Bottom</option>
                                  </select>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Description <span class="text-danger">*</span></label>
                      <textarea class="textarea form-control" rows="3" name="description_bn" placeholder="Describe about the section ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
  <script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.duallistboxroles').bootstrapDualListbox();
    $('[data-mask]').inputmask();
    $(function () {
    // Summernote
    $('.textarea').summernote()
  })
  </script>
@endsection