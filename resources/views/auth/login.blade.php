
@extends('layouts.pages')

@section('content')


<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Login</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Login</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col">

							<div class="featured-boxes">
								<div class="row">

									<div class="col-md-3 col-lg-3">
									</div>

									<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
										<div class="featured-box featured-box-primary text-left mt-5">
											<div class="box-content">

												 @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif


      

												
												<form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="{{ route('login') }}">

													{{ csrf_field() }}
<?php

    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    }
    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    else if(isset($_SERVER['HTTP_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    }
    else if(isset($_SERVER['REMOTE_ADDR'])){
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    }
    else{
        $ipaddress = 'UNKNOWN';
    }

?>

													<div class="form-row">
														<div class="form-group col">
															<label>IP Address</label>
															<input type="text" value="{{$ipaddress}}" class="form-control form-control-lg" disabled="disabled">
														</div>
													</div>

													<div class="form-row">
														<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
															<div class="col-md-6 col-lg-6">
															<label>Phone No</label>
															<input type="number" value="{{ old('phone') }}" class="form-control form-control-lg" placeholder="08123434565" name="phone" >


															 @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                						</div>
														</div>
													</div>

													
													<div class="form-row">
														<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

															<div class="col-md-6 col-lg-6">
															<a class="float-right" href="{{URL::to('/passwords/reset')}}">(Lost Password?)</a>
															<label>Password</label>
															<input type="password" value="{{old('password')}}" class="form-control form-control-lg" name="password">
															    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                								</div>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-lg-6">
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
																</label>
															</div>
														</div>
														<div class="form-group col-lg-6">
															<input type="submit" value="Login" class="btn btn-primary float-right mb-5" data-loading-text="Loading...">
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>


									<div class="col-md-3 col-lg-3">
										
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>

			</div>


				@endsection



