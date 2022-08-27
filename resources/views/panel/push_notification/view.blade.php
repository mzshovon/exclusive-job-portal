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
            <a href="{{route('create-push-notification')}}" class="btn btn-primary btn-sm">Add SMS <i class="fa fa-plus"></i></a>
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
                      Subject
                    </th>
                    <th>
                      Code
                    </th>
                    <th>
                      Success Rate
                    </th>
                    <th>
                      Language
                    </th>
                    <th>
                      Duration
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
                @forelse ($push_notifications as $notification)
                <tr data-id={{$notification->id}}>
                    <td>
                        {{$i++}}
                    </td>
                    {{-- <td>
                        {{$notification->title_en}}
                    </td> --}}
                    <td>
                        {!! $notification->subject !!}
                    </td>
                    {{-- <td>
                        {!! $notification->description_en !!}
                    </td> --}}
                    <td>
                        {!! $notification->code !!}
                    </td>
                    <td>
                        {!! $notification->success_rate !!}
                    </td>
                    <td>
                      {!! $notification->language == "en" ? "English":"Bangla" !!}
                    </td>
                    <td>
                      {{$notification->duration}}
                      0
                    </td>
                    <td>
                        @if ($notification->status == 1)
                          <span class="badge badge-success badge-sm">Active</span>
                        @else
                          <span class="badge badge-danger badge-sm">InActive</span>
                        @endif
                    </td>
                    <td>
                        {{$notification->created_at}}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{route('update-push-notification',['id'=>$notification->id])}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <button class="btn btn-default btn-sm" onclick ="sendPushNotification({{$notification->id}})" >
                          <i class="fa fa-paper-plane">
                          </i>Send SMS
                        </button>
                        {{-- </a>href="{{route('role-delete',['id'=>$user->id])}}" --}}
                        <span class="action_btn-{{$notification->id}}">
                          <button class="btn btn-{{$notification->status == 1 ? 'warning' : 'success'}} btn-sm" onclick ="changeStatus({{$notification->id}})" >
                            <i class="fas fa-{{$notification->status == 1 ? 'ban' : 'check-square'}}">
                            </i>{{$notification->status == 1 ? 'Deactivate' : 'Activate'}}
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
          url: "{{route('change-push-notification-status',['id'=>"+id+"])}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              console.log('test');
              notification_status = data.notification_status == 1 ? 'deactivated': 'activated';
              if (notification_status == 'deactivated') {
                $('tr[data-id='+id+'] td:nth-child(7)').html('<span class="badge badge-danger badge-sm">InActive</span>');
                $('.action_btn-'+id).html(`<button class="btn btn-success btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-check-square"></i> Activate</button>`);
              } else {
                $('tr[data-id='+id+'] td:nth-child(7)').html('<span class="badge badge-success badge-sm">Active</span>');
                $('.action_btn-'+id).html(`<button class="btn btn-warning btn-sm" onclick ="changeStatus(${id})">
                  <i class="fas fa-ban"></i> Deactivate</button>`);
              }
              if(status.status==200){
                Swal.fire(
                  'Status Changed!',
                  'Your selected notification has been '+notification_status+'.',
                  'success'
                  )
              };
          }
      });
    }
  })}
  function sendPushNotification(id) {
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
          url: "{{route('send-push-notification')}}",
          method: "POST",
          data: {'id': id, _token: '{{csrf_token()}}', 'page': '{{app('request')->page}}'},
          dataType: "json",
          success: function (data,statusMessage,status) {
              if(status.status==200){
                Swal.fire(
                  'Notification Sent!',
                  data.alert_message,
                  'success'
                  )
              };
          }
      });
    }
  })}
</script>
@endsection