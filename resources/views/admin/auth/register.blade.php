@extends('layouts.admin_auth_pages')

@section('content')




<div class="login-box">
  <div class="register-logo">
    <a><b>Add an admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   

    <form action="{{ URL::to('/admin/register') }}" method='POST'>

    {{ csrf_field() }}

    @if(Session::has('notification'))
                          <p class="alert alert-danger alert-sm">{{Session::get('notification')}}</p>

                        @endif


      <div class="form-group has-feedback">
      @if($errors->has('username')) <p class="alert alert-danger alert-sm">{{$errors->first('username')}}</p>@endif
                  	
        <input type="text" class="form-control" placeholder="Username" name="username" value="{{old('username')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>



      <div class="form-group has-feedback">

      @if($errors->has('password')) <p class="alert alert-danger alert-sm">{{$errors->first('password')}}</p>@endif
                  
        <input type="password" class="form-control" placeholder="Password" name="password" value="{{old('password')}}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>


      <div class="form-group">

					@if($errors->has('repassword')) <p class="alert alert-danger alert-sm">{{$errors->first('repassword')}}</p>@endif
                  	<p>
						<input type="password" name="repassword" placeholder="Confirm password" class='form-control' data-rule-required="true">
					

					
				</div>






      <div class="form-group">
					

						<select name="role" class='form-control' data-rule-required="true">
							<option value="1">Ordinary Admin</option>
							<option value="2" selected="selected">Supper Admin</option>
						</select>
					
						
					


				</div>


      <div class="row">
        <!--<div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>-->
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Add</button>
        </div>
        <!-- /.col -->
      </div>
    </form>



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



@endsection
