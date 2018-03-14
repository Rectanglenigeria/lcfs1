@extends('layouts.pages')

@section('content')



<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Forgot Password</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Forgot Password</h1>
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
												  <h4>Enter your new password below.</h4>
												  @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

                                        <form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="{{ URL::to('/passwords/update') }}">

                                      
                                                 {{ csrf_field() }}

                                                 <input type="hidden" name="user_id" value="{{$user_id}}">

                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                
                                                <div class="col-sm-12">
                                                    <input name="new_password" type="text" value="{{ old('phone') }}" id="new_password" class="form-control inputbox" required="" placeholder="Your new password" autofocus>
                                                    @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="zn_sub_button btn btn-fullcolor th-button-register" value="Update">
                                                 
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