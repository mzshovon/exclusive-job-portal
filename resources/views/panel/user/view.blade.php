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
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Users</h3>
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
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      Role Name
                    </th>
                    <th>
                      Permissions Name
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
                  $role_name = '';
              @endphp
                @forelse ($users as $user)
                @php
                  $role_name = '';
                  foreach ($user->roles as $role) {
                    $role_name = $role->name;
                  };
                @endphp
                @if ($role_name != 'app user')
                  <tr data-id={{$user->id}}>
                    <td>
                        {{$i++}}
                    </td>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                      @foreach ($user->roles as $role)
                        <span class="badge badge-primary badge-sm">{{$role->display_name}}</span>
                      @endforeach
                    </td>
                    <td>
                      @foreach ($user->roles as $role)
                        @foreach ($role->permissions as $permission)
                          <span class="badge badge-info badge-sm">{{$permission->display_name}}</span>
                        @endforeach
                      @endforeach
                    </td>
                    <td class="project-state">
                        @if ($user->is_active == 1)
                          <span class="badge badge-success badge-sm">Active</span>
                        @else
                          <span class="badge badge-danger badge-sm">InActive</span>
                        @endif
                    </td>
                    <td class="project-state">
                        {{$user->created_at}}
                    </td>
                    <td class="project-actions text-right">
                        <a class="btn btn-info btn-sm" href="{{route('user-update',['id'=>$user->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        {{-- </a>href="{{route('role-delete',['id'=>$user->id])}}" --}}
                        <button class="btn btn-{{$user->is_active == 1 ? 'warning' : 'success'}} btn-sm" onclick ="changeStatus({{$user->id}})" >
                            <i class="fas fa-{{$user->is_active == 1 ? 'ban' : 'check-square'}}">
                            </i>
                            {{$user->is_active == 1 ? 'Deactivate' : 'Activate'}}
                        </button>
                    </td>
                  </tr>                     
                @endif
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
          url: "{{route('user-status-change',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              user_status = data.user_status == 1 ? 'deactivated': 'activated';
              if (user_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(6)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('tr[data-id='+id+'] td:nth-child(8)').html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i>Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(6)').html('<span class="badge badge-success badge-sm">Active</span>');
                $('tr[data-id='+id+'] td:nth-child(8)').html(`<button class="btn btn-warning btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-ban"></i>Deactivate</button>`);
              }
              if(status.status==200){
                Swal.fire(
                  'Status Changed!',
                  'Your selected role has been '+user_status+'.',
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection