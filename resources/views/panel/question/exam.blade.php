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
      <form role="form" action="{{route($type.'-question-create',[$type == 'subject'? 'subject_id':'exam_id'=>$exam->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</b>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default" data-id="{{$exam->id}}">
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
                                    <input type="text" id="title" name="title" class="form-control" value="{{$exam ? $exam->title : ''}}" readonly>
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
                                <option value="1" {{$exam->status == 1 ? 'selected':''}}>Active</option>
                                <option value="0" {{$exam->status == 0 ? 'selected':''}}>Deactive</option>
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
                            <div class="row question_card_div" hidden>
                                <div class="col-md-3 written_subject_div" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label" for="inputSuccess">Subject <span class="text-danger">*</span></span></label>
                                        <div class="input-group">
                                            <select class="form-select form-select-lg select2 subject" id="written_subject" name="subject" style="width: 100%;">
                                                <option selected="selected" disabled>-- Select Subject --</option>
                                                @foreach ($written_subjects as $subject)
                                                 <option value="{{$subject->id}}">{{$subject->title}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-3 mcq_subject_div" hidden>
                                    <div class="form-group">
                                        <label class="col-form-label" for="inputSuccess">Subject <span class="text-danger">*</span></span></label>
                                        <div class="input-group">
                                            <select class="form-select form-select-lg select2 subject" id="mcq_subject" name="subject" style="width: 100%;">
                                                <option selected="selected" disabled>-- Select Subject --</option>
                                                @foreach ($mcq_subjects as $subject)
                                                 <option value="{{$subject->id}}">{{$subject->title}}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                      </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Assign Questions <span class="text-danger">*</span></span></label>
                                        <div class="select2-purple">
                                            <select class="select2 single-select" data-dropdown-css-class="select2-purple" multiple="multiple" data-placeholder="Select Subjects" name="subject[]" style="width: 100%;">

                                            </select>
                                        </div>
                                    </div>
                            </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Add <span class="text-danger">*</span></span></label>
                                        <div>
                                            <button type="button" class="btn btn-info add-questions-btn"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                            </div>
                                <div class="col-md-5">
                                    <table class="table table-striped projects">
                                        <thead>
                                            <tr>
                                                <th>
                                                  Question
                                                </th>
                                                <th>
                                                  Subject
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-question-body">
                                        </tbody>
                                    </table>
                            </div>
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


  <script>
    $('.subject').select2();
    $('.single-select').select2();
    $('select[name="type"]').on("change", function(){
        if($(this).find(':selected').val() == 2){
            $('.question_card_div').prop('hidden', false);
            $('.written_subject_div').prop('hidden', false);
            $('.mcq_subject_div').prop('hidden', true);
        } else if($(this).find(':selected').val() == 1){
            $('.question_card_div').prop('hidden', false);
            $('.mcq_subject_div').prop('hidden', false);
            $('.written_subject_div').prop('hidden', true);
        }

    });
    $('.subject').on("change", function(){
        $('.single-select').html(null);
        let subjectId = $(this).select2('data')[0]['id'];
        $.ajax({
          url: "{{route('exam-subject-questions')}}",
          method: "GET",
          data: {'id': subjectId, _token: '{{csrf_token()}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
            $('.single-select').select2({data : data.data});
          }
      });
    });
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

    $('.add-questions-btn').on('click', function(){
        let response = checkTotalCount();
        if(response) {
            let selectedItem = $('.single-select').select2('data');
            $(selectedItem).each((index, element) => {
                $('.table-question-body').append(`<tr><td>${element.text}
                    <input type='hidden' name= 'questions[]' value=${element.id}></td>
                    <td>${$(".subject").select2('data')[0]['text']}</td></tr>`);
            });
        }
    });

    function checkTotalCount() {
        var rowCount = $('.table-question-body tr').length;
        var questionCount = $("input[name='number']").val();
        if(questionCount == 0 || questionCount == rowCount) {
            $(document).Toasts('create', {
            class: 'bg-danger',
            title: 'Count Error',
            subtitle: 'Exclusive Job Preparation',
            body: 'Your total questions not matched to given value. Please edit the value'
            });
            return false;
        } else {
            return true;
        }
    }
    // function enableDisableSubmit(result) {
    //     let button = $("input[name='submit']");
    //     if(result) {
    //         button.prop('disabled',false);
    //     } else {
    //         button.prop('disabled',true);
    //     }
    // }


  </script>
@endsection
