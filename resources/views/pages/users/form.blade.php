@extends('layouts.lte-module')

@section('js')
@parent
<script type='text/javascript'>
    var userid = '{{$user->userid}}';
    var mode = '{{$mode}}';
</script>
<script src="{{ asset ("/js/pages/users/form.js") }}" type="text/javascript"></script>
@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        User Account
        <small>
            {{ ($mode == "ADD" ? "Register New" : "Edit") }}
        </small>       
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form class="fields-container">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <input type="text" disabled name="userid" class="form-control" value="{{ $user->userid }}" placeholder="User ID (Automatically Generated)">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" {{$mode == "ADD" ? "required" : "disabled"}} name="username" class="form-control" value="{{ $user->username }}">
                                </div>
                                <div class="form-group">
                                    <label>Complete Name</label>
                                    <input type="text" required name="complete_name" class="form-control" value="{{ $user->complete_name }}">
                                </div>
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="usertype" required class="form-control">
                                        @foreach($userTypes AS $type)
                                        <?php $selected = $type->typeid == $user->usertype ?>
                                        <option value="{{$type->typeid}}">{{$type->userdesc}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                @if($mode == "EDIT")
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" {{$mode == "ADD" ? "Required" : ""}} name="password" class="form-control">
                                </div>
                                @endif
                                <div class="form-group">
                                    <label>{{$mode == "ADD" ? "" : "New"}} Password</label>
                                    <input type="password" {{$mode == "ADD" ? "Required" : ""}}  name="new_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>{{$mode == "ADD" ? "" : "New"}} Password Repeat</label>
                                    <input type="password" {{$mode == "ADD" ? "Required" : ""}} name="new_password_repeat" class="form-control">
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- ./box-body -->
                <div class="box-footer">
                    @include('module.parts.actions')
                </div>
            </div><!-- /.box -->            
        </div>
    </div>

</section><!-- /.content -->
@endsection