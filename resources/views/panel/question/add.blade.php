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
      <form role="form" action="{{route($type.'-question-create',[$type == 'subject'? 'subject_id':'exam_id'=>$subject->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</b>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" data-id="{{$subject->id}}">
                    Upload Excel <i class="fa fa-file-excel text-success"></i>
                  </button>
                </h3>
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
                                    <input type="text" id="title" name="title" class="form-control" value="{{$subject ? $subject->title : ''}}" readonly>
                                </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputFile">Mark</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                  </div>
                                  <input type="number" id="title" name="mark" class="form-control" value="1">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleInputFile">Negative Mark</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                  </div>
                                  <input type="number" id="title" name="negative_mark" class="form-control" value="0">
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-form-label" for="inputSuccess">Status <span class="text-danger">*</span></span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                            </div>
                            <select class="form-control select2" id="status" name="status" style="width: 100%;">
                                <option selected="selected" disabled>-- Select Status --</option>
                                <option value="1" {{$subject->status == 1 ? 'selected':''}}>Active</option>
                                <option value="0" {{$subject->status == 0 ? 'selected':''}}>Deactive</option>
                              </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-form-label" for="inputSuccess">Type <span class="text-danger">*</span></span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="	fa fa-user-plus"></i></span>
                                </div>
                                <select class="form-control select2" id="status" name="type" style="width: 100%;">
                                    <option selected="selected" disabled>-- Select Type --</option>
                                    <option value="2">Written</option>
                                    <option value="1">MCQ</option>
                                </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputFile">Number of questions</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                              </div>
                              <input type="number" id="title" name="number" class="form-control">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">{{$question_card_title}}</b></h3>
                          <span class="card_header_counter" style="float: right"></span>
                        </div>
                        <div class="card-body form-data-role question_card">
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
                <input type="reset" class="btn btn-danger" name="reset" value="Reset"/>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  @include('panel.layouts.upload')
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
    $('#modal-default').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('id')
        var modal = $(this)
        var type = "{{$type}}"
        modal.find('form').attr('action',`{{url('subject/question_create_from_excel/${type}/${recipient}')}}`);
    });
    $(document).ready(function () {
      bsCustomFileInput.init();
    });
    $(function () {
    // Summernote
    $('.textarea').summernote();

    //color picker with addon
    $('.my-colorpicker2').colorpicker()
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
      });
    });
    // Input number will generate bulk questions
    $("input[name='number']").on("change", function() {
      $(".question_card").empty();
      $(".card_header_counter").html('');
      let questions =  $("input[name='number']").val();
      if($("select[name=type]").val() == 2) {
        for(let i = 1; i <= $(this).val(); i++) {
          $(".question_card").append(`<br>
        <div class="row question_section">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="inputSuccess">Question ${i}<span class="text-danger">*</span></label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                      </div>
                      <input type="text" id="title" name="question_${i}" class="form-control">
                  </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Answer <span class="text-danger">*</span></label>
              <textarea class="textarea form-control" rows="3" name="answer_${i}" placeholder="Describe about the subject ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
        </div>`).ready( function() {
            counter(parseInt(questions));
            $('.textarea').summernote()
          });
        }
      } else {
        for(let i = 1; i <= $(this).val(); i++) {
          $(".question_card").append(`<br>
        <div class="row question_section">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="inputSuccess">Question ${i}<span class="text-danger">*</span></label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                      </div>
                      <input type="text" id="title" name="question_${i}" class="form-control">
                  </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Option <span class="text-danger">*</span></label>
                  <textarea class="textarea form-control" rows="3" name="answer_${i}_1" placeholder="Describe about the subject ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <input type="radio" name="is_answer_${i}_1" value="0"> answer
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Option <span class="text-danger">*</span></label>
                  <textarea class="textarea form-control" rows="3" name="answer_${i}_2" placeholder="Describe about the subject ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <input type="radio" name="is_answer_${i}_2" value="0"> answer
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Option <span class="text-danger">*</span></label>
                  <textarea class="textarea form-control" rows="3" name="answer_${i}_3" placeholder="Describe about the subject ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <input type="radio" name="is_answer_${i}_3" value="0"> answer
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-info btn-md" id="crate_option_${i}" onclick="createOption(this.id)"><i class="fa fa-plus"></i></button>
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label" for="inputSuccess">Explanation</label>
              <textarea class="textarea form-control" rows="3" name="description_${i}" placeholder="Describe about the question and answer ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
        </div>`).ready( function() {
            counter(parseInt(questions));
            $('.textarea').summernote();
            customRadioControl();
          });
        }
      }
    })
    function counter(questions) {
      let mark = $("input[name=mark]").val();
      let total_marks = parseInt(mark) * questions;
      console.log(questions);
      $(".card_header_counter").html(`Total Questions: ${questions} || Total Marks: ${total_marks}`);
    }
    function customRadioControl() {
      $("input[type=radio]").on("click",function(){
        $(this).parent("div").parent("div").find("input[type=radio]").prop("checked",false);
        $(this).parent("div").parent("div").find("input[type=radio]").val(0);
        $(this).prop("checked",true);
        $(this).val(1);
      });
    }
    function createOption(id) {
      let className = $("#"+id).prev("div").children().last().children().last().find('textarea').attr('name');
      className = className.split("_");
      $("#"+id).prev("div").children().last().append(`
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Option <span class="text-danger">*</span></label>
                                    <textarea class="textarea form-control" rows="3" name="answer_${className[1]}_${(parseInt(className[2]) + 1)}" placeholder="Describe about the subject ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                  </div><input type="radio" name="is_answer_${className[1]}_${(parseInt(className[2]) + 1)}" value="0"> answer
                                </div>`).ready( function() {
        $('.textarea').summernote();
        customRadioControl();
        });
    }

  </script>
@endsection
