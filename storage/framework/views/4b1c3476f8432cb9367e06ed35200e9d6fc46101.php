<?php $__env->startSection('content'); ?>

			

			<div role="main" class="main">


			<!--jombothrone and registrtaion section-->

<div class="slider-with-overlay">

					<div class="slider-container rev_slider_wrapper" style="height: 660px;">
						<div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 1170, 'gridheight': 660, 'responsiveLevels': [4096,1200,992,500]}">
							<ul>
								<li data-transition="fade">
									<img src="img/slides/slide-bg-5.jpg"  
										alt=""
										data-bgposition="center center" 
										data-bgfit="cover" 
										data-bgrepeat="no-repeat" 
										class="rev-slidebg">

									<!--<div class="tp-caption"
										data-x="['177','177','center','center']" data-hoffset="['0','0','-150','-220']"
										data-y="280"
										data-start="1000"
										data-transform_in="x:[-300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>

									<div class="tp-caption top-label"
										data-x="['227','227','center','center']"
										data-y="272"
										data-fontsize="['24','24','24','36']"	
										data-start="500"
										data-transform_in="y:[-300%];opacity:0;s:500;">What is</div>

									<div class="tp-caption"
										data-x="['480','480','center','center']" data-hoffset="['0','0','150','220']"
										data-y="280"
										data-start="1000"
										data-transform_in="x:[300%];opacity:0;s:500;"><img src="img/slides/slide-title-border.png" alt=""></div>-->

									<div class="tp-caption main-label"
										data-x="['0','0','50','50']"
										data-y="['150','150','250','250']"
										data-start="1500"
										data-whitespace="nowrap"	
										data-fontsize="['50','50','80','80']"					 
										data-transform_in="y:[100%];s:500;"
										data-transform_out="opacity:0;s:500;"
										data-mask_in="x:0px;y:0px;">LAUGHTER COMMUNITY</div>

									<div class="tp-caption bottom-label"
										data-x="['0','0','center','center']"
										data-y="['220','220','350','350']"
										data-start="2000"
										data-fontsize="['30','30','50','50']"
										data-lineheight="['40','40','60','60']"
										data-transform_in="y:[100%];opacity:0;s:500;" style="text-align: center;">

											A reliable platform that allows participant <br>Sow Laughter (SL) as help to another participant<br> and have 50% returns as Reap Laughter (RL) <br>in just 10 days.
										</div>
									
								</li>
							</ul>
						</div>
					</div>

					<div class="home-intro" id="home-intro">
						<div class="container">

							<div class="row align-items-center">
								<div class="col-lg-8">
									<p>
										The fastest way to grow your profit and expand your financial <em>Capabilty</em>									</p>
								</div>
								<div class="col-lg-4">
									<div class="get-started text-left text-lg-right">
										<a href="<?php echo e(URL::to('/gsmile/create')); ?>" class="btn btn-lg btn-primary">Sow Laughter</a>
									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="slider-contact-form">
						<div class="container">

							<div class="row justify-content-end">
								<div class="col-lg-5">

									<div class="featured-boxes mt-0 mb-0">
										<div class="featured-box featured-box-primary mt-5">
											<div class="box-content">
												<h4 class="mb-0">Create Account Now</h4>
												<p>Join the fast moving train of financial liberty</p>


												 <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


												<form id="contactForm" action="<?php echo e(route('register')); ?>" name="login_form" method="POST">
														      <?php echo e(csrf_field()); ?>



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
														<div class="form-group col-md-6 col-lg-6">
															<label>IP Address</label>
															<input type="text" data-msg-required="" maxlength="100" class="form-control" name="IP" id="name" required value="<?php echo e($ipaddress); ?>" disabled="disabled">
														</div>
													
														<div class="form-group col-md-6 col-lg-6<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
															<label>Phone number</label>
															<input type="number" value="<?php echo e(old('phone')); ?>" data-msg-required="" maxlength="100" class="form-control" name="phone" id="phone" required value="08136767656">

															<?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													</div>



													<div class="form-row">

														<div class="form-group col<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
															<label>Your email address *</label>
															<input type="email" value="<?php echo e(old('email')); ?>" data-msg-required="Please enter your email address." data-msg-email="Please enter a valid email address." maxlength="100" class="form-control" name="email" id="email" required>

															<?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													</div>



													<div class="form-row">
														<div class="form-group col-md-6 col-lg-6<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
															<label>Password</label>
															<i style="color:red;" id="password_error"></i>
															<input type="password" value="" data-msg-required="Enter the password." maxlength="100" class="form-control" name="password" id="password" required="required">

															 <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													
														<div class="form-group co-lg-6 col-md-6">
															<label>Confirm Password</label>
															<i style="color:red;" id="confirm_password_error"></i>
															<input type="password" value="" data-msg-required="Confirm your password." maxlength="100" class="form-control" name="password_confirmation" id="confirm_password" required="required">
														</div>
													</div>


													 <?php if(isset($referrer_name)): ?>

                                            <input type="hidden" name="referer_phone" value="<?php echo e($referer_phone); ?>">

													<div class="form-row">

														<div class="form-group col">
															<label>Referred by</label>
															<input type="text" value="<?php echo e($referrer_name); ?>"  class="form-control" name="referrer_name" id="" disabled="disabled">

															<?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													</div>

													<?php endif; ?>





													

													<div class="form-row">
														<div class="form-group col">
															<i>* By creating an account, you accept our <a style="color:red;" href="terms">terms and conditions</a>.</i>
														</div>
														
													</div>

													<div class="form-row">
														<div class="form-group col">
															<input name="signup" value="Create Account" type="submit" class="btn btn-primary mb-5" data-loading-text="Loading...">

															<a class="" href="<?php echo e(route('login')); ?>">&nbsp;or login</a>
														</div>
														
													</div>
												</form>


												<script type="text/javascript">
													
document.getElementsByName("signup")[0].addEventListener("click", 
	function(){
		var password=document.getElementById('password').value;
		var confirm_password=document.getElementById('confirm_password').value;

		if(password != confirm_password){

			document.getElementById('password_error').innerHTML="<br>Password does not match";
			document.getElementById('confirm_password_error').innerHTML="<br>Password does not match";
		}else{

			document.getElementsByName("signup")[0].type="submit";
			var queryObject=document.querySelector("form[name=signup_form]");
			queryObject.submit();

		}

		
	});
												</script>

											</div>
										</div>
									</div>

								</div>
							</div>

						</div>
					</div>

				</div>

				<!--jombothrone and registrtaion section-->





				

				<div class="container">

					<div class="row">
						<div class="col-lg-12 text-center">
							<h2 class="word-rotator-title mb-2">Laughter community (LC) is <strong><span class="word-rotator" data-plugin-options="{'delay': 2000, 'animDelay': 300}">
								<span class="word-rotator-items">
									<span>participant first</span>
									<span>a sustainable</span>
									<span>an highly secured</span>
									<span>a reliable</span>
									<span>best ever</span>
									
								</span>
							</span></strong> donation platform that makes people financially bouyant.</h2>
							<!--<p class="lead">Trusted by over 25,000 verified participants, Laughter community is a huge success<br>, and one of the world’s largest peer-to-peer community.</p>-->
						</div>
					</div>

					<!--<div class="row mt-5 counters counters-text-dark">
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
								<label>Pledged</label>
							</div>
						</div>
						<div class="col-lg-3 col-sm-6">
							<div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
								<i class="fa fa-clock-o"></i>
								<strong data-to="1" data-append="">0</strong>
								<label>Reliable platform</label>
								
							</div>
						</div>
					</div>-->

				</div>
				<section class="section section-default section-with-mockup mb-0">
					<div class="container">
					<div class="row mb-5">
						<div class="col-lg-12 text-center">
							<h2 class="mb-5"><strong>Who</strong> We Are</h2>
							<p>LAUGHTER COMMUNITY, LC, is a unique and most secured donation platform leveraging on peer-to-peer methodology to create a society where people have maximum capabilities of living the runtimes they wish without having to rely on anyone else for cash.  This is a system where participant get 50% return on whatever sum donated to another participant in 10 days. This platform is created to serve humanity for long period of time, as good commitment policy has been put in place in order to ensure sustainability and longevity which are vital part of peer-to-peer system.  
</p>

							<a class="btn btn-outline btn-light mr-1 mb-2" href="<?php echo e(URL::to('/about')); ?>">Read More</a>
						</div>
					</div>
				</div>

				<section class="section section-default section-with-mockup mb-0" style="background-color:white;">

				<div class="container">
					<div class="row mb-4">
						<div class="col-lg-12 text-center">
							<h2 class="mb-5">How <strong>It Work<a name="hiw">s</a></strong></h2>

						</div>
						<div class="col-lg-12">
							<div class="row pt-2 clearfix">
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 reverse appear-animation animated appear-animation-visible" data-appear-animation="fadeInLeft" data-appear-animation-delay="0">
										<div class="feature-box-icon">
											<i class="icon-user-following icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Open Account</h4>
											<p class="mb-4">Log on to: laughtercommunity.com and create your account with appropriate details by inputting valid email address and phone number. Verification code will be sent to your phone. Input the code into verification form and proceed to fill up your profile details by providing valid bio data information and bank details. Save and navigate to your dashboard.  This step affords you the opportunity to take advantage of vast benefits Laughter Community offers.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 appear-animation animated appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="0">
										<div class="feature-box-icon">
											<i class="icon-layers icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Sow Laughter (SL)</h4>
											<p class="mb-4">On your dashboard, click on Sow Laughter (SL) button positioned on the navigation section. Populated the resulting form with amount you intend to sow and submit. </p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 reverse appear-animation animated appear-animation-visible" data-appear-animation="fadeInLeft" data-appear-animation-delay="300">
										<div class="feature-box-icon">
											<i class="icon-calculator icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Honour your Pledge</h4>
											<p class="mb-4">30% of your Laughter will be requested instantly as down payment to the system through secured payment gateway. The remaining 70% will be called for after five, 5, working working days by merging. In simpler words, your remaining 70% will be merged will another participant to whom you will be required to make payment to. Every participant has 24 HOURS payment time with a one-time extension of 4 to 24 hours. Always endeavor to pay earlier to avoid late confirmation.
</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 appear-animation animated appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="300">
										<div class="feature-box-icon">
											<i class="icon-star icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Match to ROI</h4>
											<p class="mb-4">After confirmation of your 30% laughter, your 10 days ROI period starts counting and the set date to Reap Laughter (RL) will vividly appear on your dashboard. Check your dashboard consistently to know whenever your remaining 70% laughter is matched to avoid a default. Any default attract irreversible blockage of the defaulter's account from the system.
</p>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 reverse appear-animation animated appear-animation-visible" data-appear-animation="fadeInLeft" data-appear-animation-delay="600">
										<div class="feature-box-icon">
											<i class="icon-drop icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Reap Laughter</h4>
											<p class="mb-4">Click on Reap Laughter (RL) button on your wallet to cash out on your RL due date. To fulfill your request, fellow participant(s) will be matched to pay you.
</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="feature-box feature-box-style-2 appear-animation animated appear-animation-visible" data-appear-animation="fadeInRight" data-appear-animation-delay="600">
										<div class="feature-box-icon">
											<i class="icon-mouse icons text-color-quaternary"></i>
										</div>
										<div class="feature-box-info">
											<h4 class="mb-2">Recommitment Policy</h4>
											<p class="mb-4">To ensure commitment, sustainability and longevity which are vital part of peer-to-peer system, 20% of your Reap Laughter (RL) value will deducted and a new Sow Laughter (SL) request will be created for you with it.
</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				</section>












































				
				
				<section class="section section-default mt-0 mb-5" >



					<div class="home-concept mt-5">
						<div class="container">

							<center><h2>Security <b>Integrations</b></h2></center>

							<div class="row justify-content-center text-center">
								<span class="sun"></span>
								<span class="cloud"></span>
								<div class="col-lg-2 ml-lg-auto">
									<div class="process-image">
										<img src="<?php echo e(asset('landing/img/landing-concept-item-1.png')); ?>" alt="" />
										<strong>Comodo</strong>
										<p class="text-color-dark mb-5">Antivirus</p>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="process-image">
										<img src="<?php echo e(asset('landing/img/landing-concept-item-2.png')); ?>" alt="" />
										<strong>2-factor</strong>
										<p class="text-color-dark mb-5">Authentication</p>
									</div>
								</div>
								<div class="col-lg-2">
									<div class="process-image">
										<img src="<?php echo e(asset('landing/img/landing-concept-item-3.png')); ?>" alt="" />
										<strong>Secured HTTPS</strong>
										<p class="text-color-dark mb-5">SSL certificate</p>
									</div>
								</div>
								<div class="col-lg-4 ml-lg-auto">
									<div class="project-image">
										<div id="fcSlideshow" class="fc-slideshow">
											<ul class="fc-slides">
												<li><a href="portfolio-single-small-slider.html"><img class="img-fluid" src="<?php echo e(asset('landing/img/landing-concept-item-4.png')); ?>" alt="" /></a></li>
												<li><a href="portfolio-single-small-slider.html"><img class="img-fluid" src="<?php echo e(asset('landing/img/landing-concept-item-5.png')); ?>" alt="" /></a></li>
												<li><a href="portfolio-single-small-slider.html"><img class="img-fluid" src="<?php echo e(asset('landing/img/landing-concept-item-6.png')); ?>" alt="" /></a></li>
											</ul>
										</div>
										<strong class="our-work">Cloud hosting</strong>
									</div>
								</div>
							</div>

						</div>
					</div>

				</section>


				<section class="section section-default mt-0 mb-5" style="background-color:white;" >

				<div class="container">

					<div class="row">
						<div class="col-lg-12 text-center">
							<h2 class="mt-5 mb-0">Unique <strong>Features</strong></h2>
							<p class="lead mb-5">Tailored to created a sustainable, efficient, highly secured and long lasting peer-to-peer platform ever.</p>
							<hr class="invisible">
						</div>
					</div>

					<div class="row align-items-center mb-0 mb-lg-4">
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">50% ROI in just 10days</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Registration with unique phone number</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">IP based login (IP address, phone number and password)</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">SMS verification</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row align-items-center mb-0 mb-lg-4">
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">#10,000 minimum SL value, #500,000 maximum </h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Flexible countdown period<span class="text-1"><small>(24 hours)</small></span></h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Flexible time extension to be granted by reaping end<span class="text-1"><small>(24 hours)</small></span></h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">30% insurance downpayent and
10% retaiment policy <span class="text-1"><small>(to be added to next RL request)</small></span></h4>
								</div>
							</div>
						</div>
					</div>
					<div class="row align-items-center mb-4">
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Unique bank details</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">5% referral bonus and
5% video testimony bonus</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Secured SSL(HTTPS) certificate</h4>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<div class="feature-box feature-box-style-6 align-items-center">
								<div class="feature-box-icon">
									<i class="fa fa-check text-color-primary"></i>
								</div>
								<div class="feature-box-info">
									<h4 class="pt-2 font-weight-semibold">Secured JAVA and PHP programming languages<span class="text-1"><small>(error free programming)</small></span></h4>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12 text-center">
							<hr>
							<h2><span class="alternative-font text-3 mt-5">and so much more...</span></h2>
						</div>
					</div>

				</div>
			</section>

				<section class="section section-background section-text-light section-center mt-5 mb-0" style="background-image: url('img/parallax-2.jpg'); background-position: 50% -100px;">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<h2><i class="fa fa-star text-1 mr-1"></i><i class="fa fa-star text-1 mr-1"></i><i class="fa fa-star text-1 mr-1"></i><i class="fa fa-star text-1 mr-1"></i><i class="fa fa-star text-1"></i><br><strong>Testimonies</strong></h2>
								<div class="owl-carousel owl-theme nav-bottom rounded-nav mb-0" data-plugin-options="{'items': 1, 'loop': false}">
									


								<?php $count =0; ?>
    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(!isset($testimony->user->name)){
        continue;
    }
    ?>

    <?php if($count >= 4) {

        break;
        }?>


									<div>
										<div class="col">
											<div class="testimonial testimonial-style-2 testimonial-with-quotes mb-0">
												<blockquote>
													<p><?php echo e(substr($testimony->message,0,65)); ?></p>
													<?php echo e(date('F d, Y', strtotime($testimony->updated_at))); ?>

													<p><a href="<?php echo e(URL::to('/testimonial/view/'.$testimony->id)); ?>" class="btn btn-danger btn-sm" role="button">View</a> </p>
												</blockquote>
												<div class="testimonial-author">
													<p><strong>{$testimony->user->name}}</strong></p>
												</div>
											</div>
										</div>
									</div>


				    <?php $count ++ ; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


									





								</div>
							</div>
						</div>
					</div>
				</section>

			</div>

			<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>