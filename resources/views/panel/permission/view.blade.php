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
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Permissions</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Permissions</h3>
        <div class="card-tools">
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
                        Permission Name
                    </th>
                    <th style="width: 30%">
                        Number of Roles Assigned
                    </th>
                    <th>
                        Total Members With Permissions
                    </th>
                    <th style="width: 8%" class="text-center">
                        Create At
                    </th>
                    <th style="width: 20%">
                      Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($permissions as $permission)
                <tr data-id={{$permission->id}}>
                    <td>
                        {{$permission->id}}
                    </td>
                    <td>
                        {{$permission->display_name}}
                    </td>
                    <td>
                        {{$permission->roles->count()}}
                    </td>
                    <td class="project_progress">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-green" role="progressbar" aria-volumenow="{{$permission->users->count()}}" aria-volumemin="0" aria-volumemax="100" style="width: {{$permission->users->count()}}%">
                            </div>
                        </div>
                        <small>
                            {{$permission->users->count()}}% Complete
                        </small>
                    </td>
                    <td class="project-state">
                        {{$permission->created_at}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{route('permission-update',['id'=>$permission->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        {{-- </a>href="{{route('role-delete',['id'=>$permission->id])}}" --}}
                        <button class="btn btn-danger btn-sm" onclick ="deleteRole({{$permission->id}})" >
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
        {{-- <div style="float: right">
          {{$permissions->links()}}
        </div> --}}
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
      
      //
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
          url: "{{route('permission-delete',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
            $('tr[data-id='+id+']').remove();
              if(status.status==200){
                Swal.fire(
                  'Deleted!',
                  'Your selected role has been deleted.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection