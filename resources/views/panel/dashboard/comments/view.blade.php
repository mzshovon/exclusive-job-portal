@extends('panel.layouts.app')

@section('content')
  <section class="content">
    <div class="container-fluid">
        <br>
      <div class="row">
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
               Comments And Replies
              </h3>
              <div class="card-tools">
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="todo-list" data-widget="todo-list">
                @forelse($comments as $comment)
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo{{$comment->id}}" id="todoCheck{{$comment->id}}" onclick="seenUnseenComment({{$comment->id}})">
                      <label for="todoCheck{{$comment->id}}"></label>
                    </div>
                    <!-- todo text -->
                    <span class="text"> {{$comment->replies->count() > 0 ? ' Replies on': 'Comment  on'}} "{{$comment->questions->first()->name}}"</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger">
                        <i class="far fa-clock"></i> {{ Carbon\Carbon::createFromFormat('d/m/Y h:i s', Carbon\Carbon::parse($comment->updated_at)->format('d/m/Y h:i s'))->diffForHumans() }}
                    </small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <a href="{{route('question-comments-view',['question_id'=>$comment->questions->first()->id])}}"<i class="fas fa-edit"></i></a>
                      <i class="fas fa-trash-o"></i>
                    </div>
                  </li>                  
                @empty
                  <h3 class="text-center">No comments </h3>
                @endforelse
              </ul>
            </div>
            <div class="card-footer clearfix">
              <a class="btn btn-info float-right text-white"><i class="fas fa-eye"></i> View All</a>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
<script>
    function seenUnseenComment(id) {
        $.ajax({
            url: "{{route('seen-unseen-comments-view')}}",
            method: "POST",
            data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
            dataType: "json",
            success: function (data) {
                console.log(data);
                status = data.status;
                $("#todoCheck"+id).parent().parent("li").delay(2500).fadeOut(2500);
                if(status==401){
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