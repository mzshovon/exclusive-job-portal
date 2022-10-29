@extends('panel.layouts.app')
@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/atatables-responsive/css/responsive.bootstrap4.min.css') }}">
@endsection
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
            <a href="{{route('video-create')}}" class="btn btn-primary btn-md">Add video Section <i class="fa fa-plus"></i></a>
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
      </div>
      <div class="card-body">
        @include('panel.layouts.alert')
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 1%">
                      #
                    </th>
                    <th>
                      Video Link
                    </th>
                    <th>
                      Title
                    </th>
                    <th>
                      Description
                    </th>
                    <th>
                      Active Status
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
                @forelse ($videos as $video)
                <tr data-id={{$video->id}}>
                    <td>
                        {{$i++}}
                    </td>
                    <td>
                        {!! $video->link !!}
                    </td>
                    <td>
                        {!! $video->title !!}
                    </td>
                    <td>
                        {!! $video->description !!}
                    </td>
                    <td>
                        @if ($video->status == 1)
                          <span class="badge badge-success badge-sm">Active</span>
                        @else
                          <span class="badge badge-danger badge-sm">InActive</span>
                        @endif
                    </td>
                    <td>
                        {{$video->created_at}}
                    </td>
                    <td class="project-actions text-right">
                        <span class="action_btn-{{$video->id}}">
                            <button class="btn btn-{{$video->status == 1 ? 'warning' : 'success'}} btn-sm" onclick ="changeStatus({{$video->id}})" >
                              <i class="fas fa-{{$video->status == 1 ? 'ban' : 'check-square'}}">
                              </i>
                              {{$video->status == 1 ? 'Deactivate' : 'Activate'}}
                            </button>
                          </span>
                        <a class="btn btn-info btn-sm" href="{{route('video-update',['id'=>$video->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    No Data available!
                </tr>
                @endforelse
            </tbody>
        </table>
      </div>
    </div>
  </section>
@endsection
@section("scripts")
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script>
  $(function () {
    $("#dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,

    });
  });
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
          url: "{{route('video-status-change',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              console.log('test');
              video_status = data.video_status == 1 ? 'deactivated': 'activated';
              if (video_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(5)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('.action_btn-'+id).html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i> Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(5)').html('<span class="badge badge-success badge-sm">Active</span>');
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
