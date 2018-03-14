@extends('layouts.admin_auth_pages')

@section('content')




<div class="login-box">
  <div class="register-logo">
    <a><b>Admin login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ URL::to('/admin/login') }}" method='POST'>

    {{ csrf_field() }}

    @if(Session::has('notification'))
                          <p class="alert alert-danger alert-sm">{{Session::get('notification')}}</p>

                        @endif


      <div class="form-group has-feedback">
      @if($errors->has('username')) <p class="alert alert-danger alert-sm">
      {{$errors->first('username')}}</p>
      @endif
                  	
        <input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>



      <div class="form-group has-feedback">

      @if($errors->has('password')) <p class="alert alert-danger alert-sm">
      {{$errors->first('password')}}</p>
      @endif
                  
        <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>


      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



@endsection
