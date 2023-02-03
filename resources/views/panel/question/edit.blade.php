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
        <form role="form" action="{{route($type.'-question-update',[$type == 'subject'? 'subject_id':($type == 'chapter' ? 'chapter_id' : 'exam_id')=>$chapter->id])}}" method="post" enctype="multipart/form-data">
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
                                            <input type="text" id="title" name="title" class="form-control" value="{{$chapter ? $chapter->title : ''}}" readonly>
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
                                                    <input type="number" id="title" name="mark" class="form-control" value="{{$chapter->questions->first()->mark}}" disabled>
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
                                                    <input type="number" id="title" name="negative_mark" class="form-control" value="{{$chapter->questions->first()->negative_mark}}" disabled>
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
                                                <option value="1" {{$chapter->status == 1 ? 'selected':''}}>Active</option>
                                                <option value="0" {{$chapter->status == 0 ? 'selected':''}}>Deactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputFile">Number of questions</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                                    </div>
                                                    <input type="number" id="title" name="number" value="{{$chapter->questions()->count()}}" readonly class="form-control">
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
                                                    <select class="form-control select2" id="status" name="type" style="width: 100%;" readonly>
                                                        <option selected="selected" readonly>-- Select Type --</option>
                                                        <option value="2" {{$chapter->questions->first()->type == 2 ? 'selected':''}}>Written</option>
                                                        <option value="1" {{$chapter->questions->first()->type == 1 ? 'selected':''}}>MCQ</option>
                                                    </select>
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
                                            @if ($chapter->questions->first()->type == 2)
                                            @forelse ($chapter->questions as $question)
                                              <br>
                                              <div class="row question_section">
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label class="col-form-label" for="inputSuccess">Question <span class="text-danger">*</span></label>
                                                          <div class="input-group">
                                                              <div class="input-group-prepend">
                                                                  <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                                              </div>
                                                              <input type="text" id="title" name="question[{{$question->id}}]" value="{{$question->name}}" class="form-control">
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                      <div class="form-group">
                                                          <label>Answer <span class="text-danger">*</span></label>
                                                          <textarea class="textarea form-control" rows="3" name="answer[{{$question->answers->first()->id}}]" placeholder="Describe about the chapter ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                          {{$question->answers->first()->name}}
                                                          </textarea>
                                                      </div>
                                                  </div>
                                              </div>
                                            @empty
                                            No Data Found!
                                            @endforelse
                                            @else
                                              @forelse ($chapter->questions as $question)
                                                <br><div class="row question_section">
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                      <label class="col-form-label" for="inputSuccess">Question {{$loop->iteration}}<span class="text-danger">*</span></label>
                                                          <div class="input-group">
                                                              <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-address-card"></i></span>
                                                              </div>
                                                              <input type="text" id="title" name="question[{{$question->id}}]" class="form-control" value="{{$question->name}}">
                                                          </div>
                                                    </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                    <div class="row">
                                                      @forelse ($question->answers as $answer)
                                                        <div class="col-md-6">
                                                          <div class="form-group">
                                                            <label>Option <span class="text-danger">*</span></label>
                                                            <textarea class="textarea form-control" rows="3" name="answer[{{$answer->id}}]" placeholder="Describe about the chapter ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                            {!! $answer->name !!}
                                                            </textarea>
                                                          </div>
                                                          <input type="radio" name="is_answer_{{$answer->id}}" value="{{$answer->is_answer == 1 ? 1: 0}}" {{$answer->is_answer == 1 ? 'checked':''}}> answer
                                                        </div>
                                                      @empty
                                                          No Data Found
                                                      @endforelse
                                                    </div>
                                                  </div>
                                                  <div class="col-md-12">
                                                    <div class="form-group">
                                                      <label class="col-form-label" for="inputSuccess">Explanation </label>
                                                      <textarea class="textarea form-control" rows="3" name="description[{{$question->id}}]" placeholder="Describe about the chapter ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                                        {!! $question->description !!}
                                                        </textarea>
                                                    </div>
                                                  </div>
                                                  </div>
                                              @empty
                                              @endforelse
                                            @endif
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
                            <input type="submit" class="btn btn-info" name="submit" value="Update" />
                            <input type="reset" class="btn btn-danger" name="reset" value="Reset" />
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
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
    $(function() {
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
        let questions = $("input[name='number']").val();
        for (let i = 1; i <= $(this).val(); i++) {
            $(".question_card").append(`<br><div class="row question_section">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-form-label" for="inputSuccess">Question <span class="text-danger">*</span></label>
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
                <textarea class="textarea form-control" rows="3" name="answer_${i}" placeholder="Describe about the chapter ..." style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
            </div>
        </div>`).ready(function() {
                counter(parseInt(questions));
                $('.textarea').summernote()
            });
        }
    })

    function counter(questions) {
        let mark = $("input[name=mark]").val();
        let total_marks = parseInt(mark) * questions;
        console.log(questions);
        $(".card_header_counter").html(`Total Questions: ${questions} || Total Marks: ${total_marks}`);
    }
    $("input[type=radio]").on("click",function(){
        $(this).parent("div").parent("div").find("input[type=radio]").prop("checked",false);
        $(this).parent("div").parent("div").find("input[type=radio]").val(0);
        $(this).prop("checked",true);
        $(this).val(1);
    });
</script>
@endsection
