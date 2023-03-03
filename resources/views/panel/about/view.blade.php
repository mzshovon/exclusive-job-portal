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
            <a href="{{route('about-create')}}" class="btn btn-primary btn-md">Add About Section <i class="fa fa-plus"></i></a>
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
                    <th style="width: 20%">
                      Title
                    </th>
                    <th style="width: 30%">
                      Description
                    </th>
                    <th>
                      Image
                    </th>
                    <th style="width: 20%" class="text-center">
                      Image Position
                    </th>
                    <th style="width: 20%" class="text-center">
                      Image Type
                    </th>
                    <th style="width: 8%">
                      Active Status
                    </th>
                    <th style="width: 8%">
                      Created At
                    </th>
                    <th style="width: 20%">
                      Actions
                    </th>
                </tr>
            </thead>
            <tbody>
              @php
                  $i=1;
              @endphp
                @forelse ($abouts as $about)
                <tr data-id={{$about->id}}>
                    <td>
                        {{$i++}}
                    </td>
                    {{-- <td>
                        {{$about->title_en}}
                    </td> --}}
                    <td>
                        {!! $about->title_en !!}
                    </td>
                    {{-- <td>
                        {!! $about->description_en !!}
                    </td> --}}
                    <td>
                        {!! $about->description_en !!}
                    </td>
                    <td>
                        <img src="{{asset($about->image_path)}}" class="gallery_image_boxed">
                    </td>
                    <td>
                      @if ($about->image_position == 1)
                        <span class="badge badge-success badge-sm">Top</span>
                      @elseif($about->image_position == 2)
                        <span class="badge badge-info badge-sm">Middle</span>
                      @else
                        <span class="badge badge-info badge-sm">Bottom</span>
                      @endif
                    </td>
                    <td>
                      @if ($about->type == 1)
                        <span class="badge badge-success badge-sm">About Us</span>
                      @elseif($about->type == 2)
                        <span class="badge badge-info badge-sm">About Exam</span>
                      @else
                        <span class="badge badge-info badge-sm">About Rule</span>
                      @endif
                    </td>
                    <td class="project-state">
                        @if ($about->is_active == 1)
                          <span class="badge badge-success badge-sm">Active</span>
                        @else
                          <span class="badge badge-danger badge-sm">InActive</span>
                        @endif
                    </td>
                    <td class="project-state">
                        {{$about->created_at}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{route('about-update',['id'=>$about->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        {{-- </a>href="{{route('role-delete',['id'=>$user->id])}}" --}}
                        <button class="btn btn-danger btn-sm" onclick ="deleteRole({{$about->id}})" >
                            <i class="fas fa-trash">
                            </i>
                            Delete
                        </button>
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
  function deleteRole(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
          url: "{{route('about-delete',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
            $('tr[data-id='+id+']').remove();
              if(status.status==200){
                Swal.fire(
                  'Deleted!',
                  'Your selected about section has been deleted.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection
