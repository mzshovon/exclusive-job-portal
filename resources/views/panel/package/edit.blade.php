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
      <form role="form" action="{{route('package-update',['id'=>$package->id])}}" method="post" enctype="multipart/form-data">
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
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="inputSuccess">Title <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                        </div>
                                        <input type="text" id="title" name="title" class="form-control" value="{{$package->title}}">
                                    </div>
                                  </div>
                                <div class="col-md-6">
                                  <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></span></label>
                                  <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                      </div>
                                      <select class="form-control" id="status" name="status" style="width: 100%;">
                                          <option selected="selected" disabled>-- Select Status --</option>
                                          <option value="1" {{$package->status == 1 ? 'selected':''}}>Active</option>
                                          <option value="0" {{$package->status == 0 ? 'selected':''}}>Deactive</option>
                                        </select>
                                  </div>
                                  </div>
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-4">
                                <label for="exampleInputFile">Icon Upload</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="icon" onchange="preview_image()">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                  </div>
                                  <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-2">
                                @if ($package->icon)
                                    <img class="icon_image" src="{{asset($package->icon)}}" style="margin:20px;height:30px;width:30px">
                                @endif
                              </div>
                              <div class="col-md-6">
                                <label>Duration:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                  </div>
                                  <input type="number" class="form-control" name="duration" value="{{$package->duration}}">
                                </div>
                                <small>** Duration will be in days **</small>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Old Price</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="number" class="form-control" name="old_price" step="any" value="{{$package->old_price}}">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Assign Models <span class="text-danger">*</span></span></label>
                                <div class="select2-purple">
                                <select class="select2" data-dropdown-css-class="select2-purple" multiple="multiple" data-placeholder="Select Models" name="model[]" style="width: 100%;">
                                  {{-- {{in_array($model->id, $subject_list) ? 'selected':''}} --}}
                                  @forelse ($models as $model)
                                    <option value="{{$model->id}}" {{in_array($model->id, $model_list) ? 'selected':''}}>{{$model->title}}</option>
                                  @empty
                                      No Data Found
                                  @endforelse
                                </select>
                              </div>
                            </div>
                          </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Assign Sections <span class="text-danger">*</span></span></label>
                                <div class="select2-purple">
                                <select class="select2" data-dropdown-css-class="select2-purple" multiple="multiple" data-placeholder="Select Models" name="section[]" style="width: 100%;">
                                  {{-- {{in_array($model->id, $subject_list) ? 'selected':''}} --}}
                                  @forelse ($sections as $section)
                                    <option value="{{$section->id}}" {{in_array($section->id, $section_list) ? 'selected':''}}>{{$section->title}}</option>
                                  @empty
                                      No Data Found
                                  @endforelse
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Color</label>
                              <div class="input-group my-colorpicker2">
                                <input type="text" class="form-control" name="color" value="{{$package->color}}">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>Reference Link</label>
                              <div class="input-group">
                                <input type="text" class="form-control" name="reference_link" value="{{$package->reference_link}}">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="form-group">
                          <label>New Price</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" name="new_price" step="any" value="{{$package->new_price}}">
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Description <span class="text-danger">*</span></label>
                      <textarea class="textarea form-control" rows="3" name="description" placeholder="Describe about the section ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!! $package->description !!}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label>About <span class="text-danger">*</span></label>
                      <textarea class="textarea form-control" rows="3" name="about" placeholder="Describe about the section ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!! $package->about !!}
                      </textarea>
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
  <script src="{{ asset('public/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
  {{-- <script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('public/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>v --}}

  <script>
    //Initialize Select2 Elements
    $('.select2').select2();
    function preview_image() {
      $(".icon_image").attr("src",URL.createObjectURL(event.target.files[0]));
    }
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.duallistboxroles').bootstrapDualListbox();
    $('[data-mask]').inputmask();
    $(function () {
    // Summernote
    $('.textarea').summernote();

    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
    })
  </script>
@endsection
