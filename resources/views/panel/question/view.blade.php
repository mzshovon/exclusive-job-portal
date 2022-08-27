@extends('panel.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ config('app.name', 'Laravel') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">{{$title}}</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{$title}}</h3>
        <div class="card-tools">
            <a href="{{route('subject-create')}}" class="btn btn-primary btn-sm">Add subject <i class="fa fa-plus"></i></a>
            <a href="{{route('subject-create')}}" class="btn btn-info btn-sm">Add subject <i class="fa fa-plus"></i></a>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body p-0">
        @include('panel.layouts.alert')
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Description
                    </th>
                    <th>
                      Icon
                    </th>
                    <th>
                      subject Covered
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Created At
                    </th>
                    <th>
                      Actions
                    </th>
                </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
                @forelse ($subjects as $subject)
                <tr data-id={{$subject->id}}>
                    <td>
                        {{$i++}}
                    </td>
                    {{-- <td>
                        {{$subject->title_en}}
                    </td> --}}
                    <td>
                        {!! $subject->title !!}
                    </td>
                    {{-- <td>
                        {!! $subject->description_en !!}
                    </td> --}}
                    <td>
                        {!! $subject->description !!}
                    </td>
                    <td>
                        <img src="{{asset($subject->icon)}}">
                    </td>
                    <td>
                      {{-- {{$subject->new_price}} --}}
                      0
                    </td>
                    <td>
                        @if ($subject->status == 1)
                          <span class="badge badge-success badge-sm">Active</span>
                        @else
                          <span class="badge badge-danger badge-sm">InActive</span>
                        @endif
                    </td>
                    <td>
                        {{$subject->created_at}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('subject-update',['id'=>$subject->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <a class="btn btn-info btn-sm" href="{{route('subject-update',['id'=>$subject->id])}}">
                            <i class="fa fa-server">
                            </i>
                            Questions
                        </a>
                        {{-- </a>href="{{route('role-delete',['id'=>$user->id])}}" --}}
                        <span class="action_btn-{{$subject->id}}">
                          <button class="btn btn-{{$subject->status == 1 ? 'warning' : 'success'}} btn-sm" onclick ="changeStatus({{$subject->id}})" >
                            <i class="fas fa-{{$subject->status == 1 ? 'ban' : 'check-square'}}">
                            </i>
                            {{$subject->status == 1 ? 'Deactivate' : 'Activate'}}
                          </button>
                        </span>
                    </td>
                </tr> 
                @empty
                <tr class="text-center">
                    No Data available!
                </tr>
                @endforelse
            </tbody>
        </table>
        <div style="float: right">
          {{$subjects->links()}}
        </div>
      </div>
    </div>
  </section>
@endsection
@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function changeStatus(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, change it!'
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          url: "{{route('subject-status-change',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              console.log('test');
              subject_status = data.subject_status == 1 ? 'deactivated': 'activated';
              if (subject_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(6)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('.action_btn-'+id).html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i> Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(6)').html('<span class="badge badge-success badge-sm">Active</span>');
                $('.action_btn-'+id).html(`<button class="btn btn-warning btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-ban"></i> Deactivate</button>`);
              }
              if(status.status==200){
                Swal.fire(
                  'Status Changed!',
                  'Your selected subject has been '+subject_status+'.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection