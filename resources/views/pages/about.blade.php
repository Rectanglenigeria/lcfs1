@extends('layouts.pages')

@section('content')
		<div role="main" class="main">



			<!--jombothrone and registrtaion section-->
	<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="#">Home</a></li>
									<li class="active">About Us</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>About Us</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<h2 class="word-rotator-title mb-4">
								The New Way to Financial
								<strong class="inverted inverted-primary">
									<span class="word-rotator" data-plugin-options="{'delay': 2000, 'animDelay': 300}">
										<span class="word-rotator-items">
											<span>success.</span>
											<span>advancement.</span>
											<span>progress.</span>
										</span>
									</span>				
								</strong>
							</h2>

							<p class="lead">
								LAUGHTER COMMUNITY, LC, is a unique and most secured donation platform leveraging on peer-to-peer methodology to create a society where people have maximum capabilities of living the runtimes they wish without having to rely on anyone else for cash.  This is a system where participant get 50% return on whatever sum donated to another participant in 10 days. This platform is created to serve humanity for long period of time, as good commitment policy has been put in place in order to ensure sustainability and longevity which are vital part of peer-to-peer system. 
							</p>

							<hr class="tall">
							<h2 class="word-rotator-title mb-4">
								Our Core Values
							</h2>
						</div>
					</div>
					<div class="row">

						
						<div class="col-lg-12">

							<div class="row">



							<div class="feature-box feature-box-style-2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="feature-box-icon">
									<i class="fa fa-group"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="mb-2">Sustainability</h4>
									<p class="mb-4">This platform is created to serve people for long period of time and proper strategies have been and are being implemented to ensure its sustainability. Your investment can't be safer anywhere than in Laughter Community
</p>
								</div>
							</div>

							<div class="feature-box feature-box-style-2 col-lg-6 col-md-6 col-sm-12 col-xs-12"">
								<div class="feature-box-icon">
									<i class="fa fa-file"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="mb-2">Consistency</h4>
									<p class="mb-4">We will ensure that participants get all their entitlements consistently. At Laughter Community, we are selfless, effective and efficient in our service delivery and platform management.
</p>
								</div>
							</div>

						</div>
						</div>


						<div class="col-lg-12">

							<div class="row">
							
							<div class="feature-box feature-box-style-2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="feature-box-icon">
									<i class="fa fa-check"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="mb-2">User satisfaction</h4>
									<p class="mb-4">We treat participants with utmost respect and as a result of this, their utmost satisfaction is our priority. We shall always improve in all necessary areas to make you happy ceaselessly.
</p>
								</div>
							</div>
						
							<div class="feature-box feature-box-style-2 col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="feature-box-icon">
									<i class="fa fa-bars"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="mb-2">Security</h4>
									<p class="mb-4">At Laughter Community, Our service delivery system includes improved electronic security systems and secure servers installed to ensure that information with us are fully classified. We provide two-factor authentication.<p>
								</div>
							</div>
							
						</div>

					</div>
					</div>
				</div>
<!--
				<section class="section section-primary mb-0">
					<div class="container">
						<div class="row counters counters-text-light">
							<div class="col-lg-3 col-sm-6">
							<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
								<i class="fa fa-user"></i>
								<strong data-to="1000" data-append="+">0</strong>
								<label>Laughing participants</label>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
								<i class="fa fa-desktop"></i>
								<strong data-to="24901">0</strong>
								<label>SL pledges</label>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="900">
								<i class="fa fa-ticket"></i> 
								<strong data-to="100" data-append="M+">0</strong>
								<label>SL Investment value</label>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
								<i class="fa fa-clock-o"></i>
								<strong data-to="1" data-append="">0</strong>
								<label>Reliable platform</label>
								
							</div>
						</div>
						</div>
					</div>
				</section>-->

				

				

				<section class="call-to-action call-to-action-default with-button-arrow content-align-center call-to-action-in-footer">
					<div class="container">
						<div class="row">
							<div class="col-md-9 col-lg-9">
								<div class="call-to-action-content">
									<h3>Laughter community is <strong>everything</strong> you need to grow your <strong>profit</strong> and expand your financial <strong>capability</strong></h3>
									<p class="mb-0">...Making you laugh to finacial prosperity</p>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="call-to-action-btn">
									<a href="{{URL::to('/register')}}" target="_blank" class="btn btn-lg btn-primary">Create Account!</a><span class="arrow hlb d-none d-md-block" data-appear-animation="rotateInUpLeft" style="top: -40px; left: 70%;"></span>
								</div>
							</div>
						</div>
					</div>
				</section>

			</div>










@endsection()