@extends('panel.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <form role="form" action="{{route('role-update',['id'=>$role->id])}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Role</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body form-data-role">
                @include('panel.layouts.alert')
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess">Role Name <span class="text-danger">*</label>
                  <input type="text" class="form-control name" id="inputSuccess" name="name" value="{{$role->name}}" placeholder="Enter Valid Role Name in Lower Case..." required>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess">Display Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control display_name" id="inputSuccess" name="display_name" value="{{$role->display_name}}" placeholder="Enter Valid Role Name in Small Letter..." readonly>
                </div>
                <div class="form-group">
                  <label>Description <small>(Optional)</small></label>
                  <textarea class="form-control" rows="3" name="description" placeholder="Describe about the role ...">
                    {{$role->description}}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Assign Permissions</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="form-group">
                      <div class="row">
                        @forelse ($permissions as $permission)
                          <div class="col-md-6">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{$permission->id}}" id="customSwitch{{$permission->id}}" {{in_array($permission->id,$role_permissions) ? 'checked':''}}>
                              <label class="custom-control-label" for="customSwitch{{$permission->id}}">{{$permission->permission_name_view()}}</label>
                            </div>
                          </div>
                          @empty
                          No Permissions found!
                      @endforelse
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <input type="submit" class="btn btn-info" name="submit" value="Submit"/>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection
@section('scripts')
  <script>
    $(".name").on("blur",function(){
      if($(this).val() != $(this).val().toLowerCase()) {
        $(document).Toasts('create', {
          class: 'bg-danger', 
          title: 'Case Error',
          subtitle: 'Laracom.',
          body: 'You have missed case objective. Please input the role name in all lower case'
        });
        $(this).addClass('is-invalid');
        $(".display_name").val('');
        $("input[name=submit]").prop('disabled',true);
      } else{
        $(this).addClass('is-valid');
        $(".display_name").val($(this).val().charAt(0).toUpperCase()+$(this).val().slice(1));
        $("input[name=submit]").prop('disabled',false);
      }
    });
  </script>
@endsection