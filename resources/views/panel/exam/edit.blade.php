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
      <form role="form" action="{{route('exam-update',['id'=>$exam->id])}}" method="post" enctype="multipart/form-data">
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
                                    <input type="text" id="title" name="title" class="form-control" value="{{$exam->title}}">
                                </div>
                          </div>
                            <div class="form-group">
                              <div class="row">
                                <div class="col-md-6">
                                  <label>Start and End date (Optional)</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-calendar"></i></span>
                                    </div>
                                    {{-- {{Carbon\Carbon::parse($exam->start_date)->format('d/m/Y').' - '.Carbon\Carbon::parse($exam->end_date)->format('d/m/Y')}} --}}
                                    <input type="text" class="form-control float-right" id="reservationtime" name="date_duration" value="{{$exam->start_date && $exam->end_date ? Carbon\Carbon::parse($exam->start_date)->format('m/d/Y').' - '.Carbon\Carbon::parse($exam->end_date)->format('m/d/Y'):''}}">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <label>Duration:</label>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    <input type="number" class="form-control" name="duration" value="{{$exam->duration}}">
                                  </div>
                                </div>
                              </div>
                              <!-- /.input group -->
                            </div>
                          <div class="form-group">
                            <label>Assign Subjects (Optional)</label>
                            <select class="form-control select2bs4" data-placeholder="Select Subjects" name="chapter[]" style="width: 100%;" {{$exam->chapters->count() > 0 ? 'disabled':''}}>
                              <option disabled {{$exam->chapters->count() == 0?'selected':''}}>------Select Chapter------</option>
                              @forelse ($chapters as $chapter)
                                <option value="{{$chapter->id}}" {{$exam->chapters->count() > 0 && $exam->chapters->first()->id == $chapter->id?'selected':''}}>{{$chapter->title}}</option>
                              @empty
                                  No Data Found
                              @endforelse
                            </select>
                          </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="row">
                          <div class="col-md-6">
                            <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control" id="status" name="status" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Status --</option>
                                    <option value="1" {{$exam->status == 1 ? 'selected':''}}>Active</option>
                                    <option value="0" {{$exam->status == 0 ? 'selected':''}}>Deactive</option>
                                  </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label class="col-form-label" for="inputSuccess">Type <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control" id="status" name="exam_type" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Type --</option>
                                    <option value="1" {{$exam->exam_type == 1 ? 'selected':''}}>Online Test</option>
                                    <option value="2" {{$exam->exam_type == 2 ? 'selected':''}}>IQ Test</option>
                                  </select>
                            </div>
                          </div>
                        </div>
                      </div>
                        <!-- Date and time range -->
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Start Time (Optional)</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="time" class="form-control float-right" name="start_time" value="{{$exam->start_time ? Carbon\Carbon::parse($exam->start_time)->format('A h:i'):''}}">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label>End Time (Optional)</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                <input type="time" class="form-control float-right" name="end_time" value="{{$exam->end_time ? Carbon\Carbon::parse($exam->end_time)->format('A h:i'):''}}">
                              </div>
                            </div>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Color (Optional)</label>
                              <div class="input-group my-colorpicker2">
                                <input type="text" class="form-control" name="color" value="{{$exam->color}}">
                                <div class="input-group-append">
                                  <span class="input-group-text"><i class="fas fa-square"></i></span>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <label for="exampleInputFile">Icon Upload (Optional)</label>
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="icon">
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
                    <div class="col-md-12">
                    <div class="form-group">
                      <label>Description <span class="text-danger">*</span></label>
                      <textarea class="textarea form-control" rows="3" name="description" placeholder="Describe about the exam ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>
                      {!! $exam->description !!}
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
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.duallistboxroles').bootstrapDualListbox();
    $('[data-mask]').inputmask();
    $('#reservationtime').daterangepicker();
    $(function () {
    // Summernote
      $('.textarea').summernote();
      // Select2
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
      //color picker with addon
      $('.my-colorpicker2').colorpicker()
      $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
    })
  </script>
@endsection
