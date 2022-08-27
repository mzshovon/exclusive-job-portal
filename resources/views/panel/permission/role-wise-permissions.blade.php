@extends('panel.layouts.app')
@section('content')
<section class="content-header">
    <div class="container-fluid">
                    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Role: <b>{{strtoupper($role->name)}}</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="form-group">
                      <div class="row">
                        @forelse ($permissions as $permission)
                          <div class="col-md-3">
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
  </section>
@endsection