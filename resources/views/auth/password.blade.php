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
												<h4 class="heading-primary text-uppercase mb-3">Enter your phone number</h4>
												   @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

                                        <form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="{{ URL::to('/passwords/reset') }}">

                                       
                                                 {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                              
                                                <div class="col-sm-12">
                                                    <input name="phone" type="tel" value="{{ old('phone') }}" id="phone" class="form-control inputbox" required="" placeholder="08078867768" autofocus>
                                                    @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="zn_sub_button btn btn-fullcolor th-button-register" value="Submit">
                                                 
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