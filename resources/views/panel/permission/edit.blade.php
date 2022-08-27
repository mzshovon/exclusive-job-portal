@extends('panel.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <form role="form" action="{{route('permission-update',['id'=>$permission->id])}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Permission</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body form-data-role">
                @include('panel.layouts.alert')
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess">Permission Name <span class="text-danger">*</label>
                  <input type="text" class="form-control name" id="inputSuccess" name="name" value="{{$permission->name}}" placeholder="Enter Valid Permission Name in Format like user-create etc...." required>
                  <small class="text-secondary">** Use permission name like user-create, product-create etc.</small>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="inputSuccess">Display Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control display_name" id="inputSuccess" name="display_name" value="{{$permission->display_name}}" placeholder="Enter Valid Permission Name in Format like user-create etc...." readonly>
                </div>
                <div class="form-group">
                  <label>Description <small>(Optional)</small></label>
                  <textarea class="form-control" rows="3" name="description" placeholder="Describe about the role ...">
                    {{$permission->description}}
                  </textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Assign Roles</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="form-group">
                      <div class="row">
                        @forelse ($roles as $role)
                          <div class="col-md-6">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input type="checkbox" class="custom-control-input" name="roles[]" value="{{$role->id}}" id="customSwitch{{$role->id}}" {{in_array($role->id,$permission_roles) ? 'checked':''}}>
                              <label class="custom-control-label" for="customSwitch{{$role->id}}">{{$role->display_name}}</label>
                            </div>
                          </div>
                          @empty
                          No Roels found!
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
      if($(this).val().indexOf('-') == -1 || $(this).val().length == 0) {
        $(document).Toasts('create', {
          class: 'bg-danger', 
          title: 'Case Error',
          subtitle: 'Laracom.',
          body: 'You have missed case objective. Please input the permission name with one hyphen(-).'
        });
        $(this).addClass('is-invalid');
        $(".display_name").val('');
        $("input[name=submit]").prop('disabled',true);
      } else{
        $(this).addClass('is-valid');
        $(".toasts-top-right").remove();
        string = $(this).val().split('-');
        first_string = string[1].charAt(0).toUpperCase()+string[1].slice(1);
        second_string = string[0].charAt(0).toUpperCase()+string[0].slice(1);
        // second_string = second_string.endsWith("s") ? second_string: second_string +'s';
        $(".display_name").val(first_string+' '+second_string);
        $("input[name=submit]").prop('disabled',false);
      }
    });
  </script>
@endsection