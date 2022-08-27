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
          <a href="{{route('excel-user-export')}}" class="btn btn-info btn-sm">Export Excel <i class="fa fa-file-excel"></i></a>
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
                    <th>
                      #
                    </th>
                    <th>
                      Name
                    </th>
                    <th>
                      Email
                    </th>
                    <th>
                      IP Address
                    </th>
                    <th>
                      Address
                    </th>
                    <th>
                      Gender
                    </th>
                    <th>
                      Mobile
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
                @forelse ($users as $user)
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
                      {{$user->profile && $user->profile->ip_address ? $user->profile->ip_address : 'N/A'}}
                    </td>
                    <td>
                      {{$user->address ? $user->address : 'N/A'}}
                    </td>
                    <td>
                      {{$user->profile && $user->profile->sex ? $user->profile->sex : 'N/A'}}
                    </td>
                    <td>
                      {{$user->mobile ? $user->mobile : 'N/A'}}
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
                      <button class="btn btn-{{$user->is_active == 1 ? 'warning' : 'success'}} btn-sm" onclick ="changeStatus({{$user->id}})" ><i class="fas fa-{{$user->is_active == 1 ? 'ban' : 'check-square'}}">
                        </i> {{$user->is_active == 1 ? 'Deactivate' : 'Activate'}}</button>
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
          url: "{{route('user-status-change',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              user_status = data.user_status == 1 ? 'deactivated': 'activated';
              if (user_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(8)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('tr[data-id='+id+'] td:nth-child(10)').html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i>Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(8)').html('<span class="badge badge-success badge-sm">Active</span>');
                $('tr[data-id='+id+'] td:nth-child(10)').html(`<button class="btn btn-warning btn-sm" onclick ="changeStatus(${id})">
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