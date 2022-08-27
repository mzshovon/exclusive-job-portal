@extends('panel.layouts.app')

@section('stylesheet')
    <style>
        .reply_div {
            padding: 5px;
            width:70%;
            border-radius:4px;
            margin:auto;
            margin-bottom:4px;
        }
    </style>
@endsection
@section('content')
  <section class="content">
    <div class="container-fluid">
        <br>
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
               Comments And Replies
              </h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                      <div class="timeline">
                        <div class="time-label">
                          <span class="bg-info">Question: {{$question->name}}</span>
                        </div>
                        @foreach ($question->comments as $comment)
                        <div>
                            <i class="fas fa-comment bg-blue"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock"></i> {{Carbon\Carbon::parse($comment->updated_at)->format("h:i a ,d-m-Y")}}</span>
                              <h3 class="timeline-header"><a href="#">{{$comment->user()->name}}</a> Commented on question</h3>
            
                              <div class="timeline-body">
                                {!! $comment->comment !!}
                              </div>
                              <div class="timeline-footer">
                                <a class="btn btn-primary btn-sm">Reply</a>
                                <a class="btn btn-info btn-sm">Edit</a>
                                <a class="btn btn-danger btn-sm">Delete</a>
                              </div>

                            </div>
                          </div>
                          @if ($comment->replies()->count() > 0)
                          @foreach ($comment->replies as $reply)
                            <div class="bg-gray reply_div">
                                <span> <i class="fas fa-comments bg-yellow" style="padding: 2px;border-radius:50%"></i> {{$reply->reply}} 
                                    - <small>
                                        <i>Replied by <b>{{$reply->user()->name}}</b></i>
                                    </small>
                                </span>
                                <span style="float: right"><i class="fas fa-clock"></i> <small>{{Carbon\Carbon::parse($reply->updated_at)->format("h:i a ,d-m-Y")}}</small></span>
                            </div>
                          @endforeach
                          @endif
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    {{-- <label>Comment <span class="text-danger">*</span></label> --}}
                    <textarea class="textarea form-control" rows="3" name="comment" placeholder="Comment here ..."></textarea>
                  </div>
            </div>
            <div class="card-footer clearfix">
              <button class="btn btn-info float-right text-white" onclick="storeComment({{$question->id}})"><i class="fas fa-comment"></i> Comment</button>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
<script>
    function storeComment(id) {
        $.ajax({
            url: "{{route('comments-store')}}",
            method: "POST",
            data: {'id': id, 'comment': $("textarea[name=comment]").val(), _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
            dataType: "json",
            success: function (data) {
                console.log(data);
                status = data.status;
                if(status==200){
                  $(".timeline").append(`
                  <div>
                      <i class="fas fa-comment bg-blue"></i>
                      <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> ${data.created_at}</span>
                        <h3 class="timeline-header"><a href="#">${data.username}</a> Commented on question</h3>
      
                        <div class="timeline-body">
                          ${data.comment.comment}
                        </div>
                        <div class="timeline-footer">
                          <a class="btn btn-primary btn-sm">Reply</a>
                          <a class="btn btn-info btn-sm">Edit</a>
                          <a class="btn btn-danger btn-sm">Delete</a>
                        </div>

                      </div>
                    </div>
                  `);
                  $("textarea[name=comment]").html('');
                } else {
                  Swal.fire(
                    'Comment!',
                    'Something error',
                    'error'
                    )
                }
            }
        });
    }
</script>
@endsection
