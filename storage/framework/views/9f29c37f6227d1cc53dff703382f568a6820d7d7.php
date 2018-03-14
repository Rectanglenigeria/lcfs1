<!doctype html>
<html lang="<?php echo e(config('app.locale')); ?>">

<!-- Mirrored from demos.hogash.com/Smilesteadily_template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2017 10:09:48 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<!-- meta -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<!-- Uncomment the meta tags you are going to use! Be relevant and don't spam! -->

	<meta name="keywords" content="Smilesteadily, give smile, receive smile. give help, receive help, peer-to-peer, donation platform, mmm" />
	<meta name="description" content=" SMILESTEADILY is a peer-to-peer donating platform that is created out of unbridled passion to see a society where every man will enjoy financial success regardless of age, sex or social class. This is a platform where one gets double of whatever sum donated to a fellow participant in the next 15 days after payment confirmation. This translates to a whopping 100% returns on your donation.">

	<!-- Title -->
	<?php if(isset($ActiveTab)): ?>
	<title><?php echo e("Smilesteadily | ".ucwords($ActiveTab)); ?></title>
	<?php else: ?>
	<title><?php echo e("Smilesteadily"); ?></title>
	<?php endif; ?>
	

	<!--  Desktop Favicons  -->
	<link rel="icon" type="image/png" href="<?php echo e(asset('public/pages/images/favicons/favicon-16x16.png')); ?>" sizes="16x16">
	<!-- <link rel="icon" type="image/png" href="images/favicons/favicon-32x32.png" sizes="32x32"> -->
	<!-- <link rel="icon" type="image/png" href="images/favicons/favicon-96x96.png" sizes="96x96"> -->

	<!-- Google Fonts CSS Stylesheet // More here http://www.google.com/fonts#UsePlace:use/Collection:Open+Sans -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400italic,400,600,600italic,700,800,800italic" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

	<!-- ***** Boostrap Custom / Addons Stylesheets ***** -->
	<link rel="stylesheet" href="<?php echo e(asset('public/pages/css/bootstrap.css')); ?>" type="text/css" media="all">


	<!-- ***** Main + Responsive & Base sizing CSS Stylesheet ***** -->
	<link rel="stylesheet" href="<?php echo e(asset('public/pages/css/template.css')); ?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo e(asset('public/pages/css/responsive.css')); ?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo e(asset('public/pages/css/base-sizing.css')); ?>" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo e(asset('public/pages/css/dp.css')); ?>" type="text/css" media="all">
	

	<!-- Modernizr Library -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/modernizr.min.js')); ?>"></script>

	<!-- jQuery Library -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/jquery.js')); ?>"></script>
  
  <style>

  	.neatest
  	{
  		padding: 25px 30px;
  		background: rgba(255,255,255,0.3);
  		color:#272727;
  		border-radius: 4px;
  	}
   @media  only screen and (max-width: 600px)
    {
      .header-links-container
      {
      display: none;
      }
    }

    
  @media  only screen and (min-width: 500px)
    {
      
      .left-seeding
      {
        display: none;
      }
      
    }
    
    .left-seeding
    {
      color: white;
    }
    .myClass
      {
        margin: 0 0;
        color: #ffffff;
        list-style-type: none;  
      }
      .myClass  li
      {
        display: inline-block;
        color: #fff;
      }
      .myClass li a
      {
        color: floralwhite;
      }

  </style>

   <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

</head>

<body class="">
	

		<!-- Page Wrapper -->
	<div id="page_wrapper">
		<div id="dp-js-header-helper" style="height:0 !important; display:none !important;"></div>
<!-- Header style 1 -->
<header id="header" class="site-header style1 cta_button" style="background-color: rgba(0,0,0,0.6);" >
	<!-- header bg -->
<!--	<div class="kl-header-bg"></div>-->
	<!--/ header bg -->

	<!-- siteheader-container -->
	<div class="container siteheader-container">
		<!-- top-header -->
<!--		<div class="kl-top-header clearfix">-->
			<!-- HEADER ACTION -->
			<div class="header-links-container ">
				<ul class="topnav navRight topnav">
					<!-- Support panel trigger -->
                  
                  <li>

                  <?php if(Auth::check()): ?>
                  <a href="<?php echo e(URL::to('/dashboard')); ?>">
                  	<?php echo e(Auth::user()->email); ?>

                  </a>
                  <?php else: ?>
                  
                  <?php if(!isset($ActiveTab) || (isset($ActiveTab) && $ActiveTab==null) ||(isset($ActiveTab) && $ActiveTab=='register')): ?>
						<a class="popup-with-form hidden-md hidden-lg hidden-sm" href="#register_panel">
							<i class="glyphicon glyphicon-log-in visible-xs xs-icon"></i>
							<span class="hidden-xl">SIGN UP</span>
						</a>
				<?php endif; ?>
						
						<?php endif; ?>
					</li>

					<!--/ Support panel trigger -->

					<!-- Login trigger -->
					<li>

					<?php if(Auth::check()): ?>
						<a class="popup-with-form" href="<?php echo e(URL::to('/logout')); ?>">
							<i class="glyphicon glyphicon-log-in visible-xs xs-icon"></i>
							<span class="hidden-xl">LOGOUT</span>
						</a>
					<?php else: ?>
					 <?php if(!isset($ActiveTab) || (isset($ActiveTab) && $ActiveTab==null) ||(isset($ActiveTab) && $ActiveTab=='register')): ?>
						<a class="popup-with-form hidden-md hidden-lg hidden-sm" href="#login_panel">
							<i class="glyphicon glyphicon-log-in visible-xs xs-icon"></i>
							<span class="hidden-xl">LOGIN</span>
						</a>
						<?php endif; ?>
					<?php endif; ?>
						
					</li>
					<!--/ Login trigger -->			
				</ul>
              
				<!--/ Languages -->

				
			</div>
			<!--/ HEADER ACTION -->

			<!-- HEADER ACTION left -->
			<div class="header-leftside-container ">
				<!-- Header Social links -->
				<!--/ Header Social links -->

<!--				<div class="clearfix visible-xxs">-->
<!--				</div>-->

				<!-- header contact text -->


              <div class="left-seeding">

              <ul class="myClass">
					<center>

					<li>
						<label for="support_p" class="spanel-label">                   		
                          <span class="default"><a href="<?php echo e(URL::to('/register')); ?>" class="">Home&nbsp;|</a></span>
                      </label>
					</li>
                    
                    <li>
				      <label for="support_p" class="spanel-label">
                    		
                          <span class=" "><a href="<?php echo e(URL::to('/about')); ?>" class="">&nbsp;About Us&nbsp;|</a></span>
				      </label>
					</li>
                
                  <li>
				      <label for="support_p" class="spanel-label">
                    		
                          <span class=" "><a href="<?php echo e(URL::to('/contact')); ?>" class="">&nbsp;Contact Us&nbsp;|</a></span>
				      </label>
				</li>
                
                
                <li>
				      <label for="support_p" class="spanel-label">
                    		
                          <span class=" "><a href="<?php echo e(URL::to('/register#hiw')); ?>" class="">&nbsp;How It Works&nbsp;|</a></span>
				      </label>
				</li>
                
                <li>
				      <label for="support_p" class="spanel-label">
                    		
                          <span class=" "><a href="<?php echo e(URL::to('/faqs')); ?>" class="">&nbsp;Faqs&nbsp;|</a></span>
				      </label>
				</li>
                
                <li>
				      <label for="support_p" class="spanel-label">
                    		
                          <span class=" "><a href="<?php echo e(URL::to('/testimonial')); ?>" class="">&nbsp;Testimonials</a></span>
				      </label>
				</li>

				<br>
                                <li><a href="https://www.facebook.com/smilesteadily/" target="_self" class="icon-facebook" title="Facebook"></a></li>
                                &nbsp;&nbsp;
                                <li><a href="https://twitter.com/smilesteadily" target="_self" class="icon-twitter" title="Twitter"></a></li>   
                                &nbsp;&nbsp;&nbsp;
                                <li><a href="https://t.me/joinchat/GAMyzULiiYY2fWDH5rek4A" target="_self" class="icon-telegram" title="Dribbble">Telegram</a></li>
                                <!--<li><a href="#" target="_blank" 
				</center> 
              </ul>


				
				<!--/ header contact text -->
			</div>
			<!--/ HEADER ACTION left -->
		</div>
		<!--/ top-header -->
		
		<!-- separator -->
		<!--/ separator -->

		<!-- left side -->
		<!-- logo container-->

		<div class="logo-container hasInfoCard logosize--yes hidden-sm hidden-xs">
			 
			<h1 class="site-logo logo" id="logo">
				<a href="<?php echo e(URL::to('/register')); ?>" title="">
					<img src="<?php echo e(asset('public/pages/images/smilelog.png')); ?>" class="logo-img" alt="Smile Steadily" title="Smiles steadily" style="width:150px;"/>
				</a>
			</h1>
			<!--/ Logo -->

			
	</div>
		<!--/ logo container-->

		<!-- separator -->
		<div class="separator visible-xxs"></div>
		<!--/ separator -->

		<!-- responsive menu trigger -->
		<div id="zn-res-menuwrapper" class="hidden-xs hidden-sm">
			<a href="#" class="zn-res-trigger zn-header-icon"></a>
		</div>
		<!--/ responsive menu trigger -->

		<!-- main menu -->
		<div id="main-menu" class="main-nav zn_mega_wrapper hidden-xs hidden-sm">

			<ul id="menu-main-menu" class="main-menu zn_mega_menu">
				<li class="menu-item-has-children menu-item-mega-parent
				<?php if(!isset($ActiveTab) || (isset($ActiveTab) && $ActiveTab==null)): ?>
				<?php echo e('active'); ?>

				<?php endif; ?>"><a href="<?php echo e(URL::to('/register')); ?>">HOME</a>

				</li>
				<li class="menu-item-has-children menu-item-mega-parent
				<?php if(isset($ActiveTab) && $ActiveTab=='about'): ?>
				<?php echo e('active'); ?>

				<?php endif; ?>"><a href="<?php echo e(URL::to('/about')); ?>">ABOUT US</a>
						
				</li>
				<li class="menu-item-has-children
				<?php if(isset($ActiveTab) && $ActiveTab=='contact'): ?>
				<?php echo e('active'); ?>

				<?php endif; ?>"><a href="<?php echo e(URL::to('/contact')); ?>">CONTACT US</a>
					
				</li>
				<li class="menu-item-has-children"><a href="<?php echo e(URL::to('/register#hiw')); ?>">HOW IT WORKS</a>

				</li>
				<li class="menu-item-has-children
				<?php if(isset($ActiveTab) && $ActiveTab=='faqs'): ?>
				<?php echo e('active'); ?>

				<?php endif; ?>"><a href="<?php echo e(URL::to('/faqs')); ?>">FAQS</a>
					
				</li>
				<li class="menu-item-has-children menu-item-mega-parent
				<?php if(isset($ActiveTab) && $ActiveTab=='testimonial'): ?>
				<?php echo e('active'); ?>

				<?php endif; ?>"><a href="<?php echo e(URL::to('/testimonial')); ?>">TESTIMONIAL</a>
					
				</li>
				
			</ul>

  </div>

		<!--/ main menu -->

		<!-- right side -->	
		<!-- Call to action ribbon Free Quote -->
		<a href="#" id="ctabutton" class="ctabutton kl-cta-ribbon hidden" title="GET A FREE QUOTE" target="_self"><strong>FREE</strong>QUOTE<svg version="1.1" class="trisvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" preserveaspectratio="none" width="14px" height="5px" viewbox="0 0 14.017 5.006" enable-background="new 0 0 14.017 5.006" xml:space="preserve"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.016,0L7.008,5.006L0,0H14.016z"></path></svg></a>
		<!--/ Call to action ribbon Free Quote -->

		<!-- Shop Cart -->
		<!--/ Shop Cart -->
     </div>
<!--	</div>-->
	<!--/ siteheader-container -->
</header>
<!-- / Header style 1 -->		

<!-- / Header style 1 -->		

<!-- / Header style 1 -->

<!-- social-icons -->

<?php echo $__env->yieldContent('content'); ?>





<!-- Footer - Default Style -->
		<div id="dp-js-footer-helper" style="height:0 !important; display:none !important;"></div>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div>
							<h3 class="title m_title">FOOTER MENU</h3>
							<div class="sbs">
								<ul class="menu">
									<li><a href="<?php echo e(URL::to('/register')); ?>">HOME</a></li>
									<li><a href="<?php echo e(URL::to('/about')); ?>">ABOUT US</a></li>
									<li><a href="<?php echo e(URL::to('/contact')); ?>">CONTACT US</a></li>
									<li><a href="<?php echo e(URL::to('/register#hiw')); ?>">HOW IT WORKS</a></li>
									<li><a href="<?php echo e(URL::to('/faqs')); ?>">FAQS</a></li>
									<li><a href="<?php echo e(URL::to('/testimonial')); ?>">TESTIMONIALS</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!--/ col-sm-5 -->

					
					<!-- col-sm-4 -->

					<div class="col-sm-3">
						<div>
							<h3 class="title m_title">GET IN TOUCH</h3>
							<br>
								Email: <a href="#">admin@smilesteadily.com</a></p>
								
								
							</div>
						</div>
					</div>
					<!--/ col-sm-3 -->
				</div>
				<!--/ row -->

				

				<div class="row">
					<div class="col-sm-12">
						<div class="bottom clearfix">
							<!-- social-icons -->
							<ul class="social-icons sc--clean clearfix">
								<li class="title">GET SOCIAL</li>
								<li><a href="https://www.facebook.com/smilesteadily/" target="_self" class="icon-facebook" title="Facebook"></a></li>
								<li><a href="https://twitter.com/smilesteadily" target="_self" class="icon-twitter" title="Twitter"></a></li>	
								<li><a href="https://t.me/joinchat/GAMyzULiiYY2fWDH5rek4A" target="_self" class="icon-telegram" title="Dribbble">Telegram</a></li>
								<!--<li><a href="#" target="_blank" class="icon-google" title="Google Plus"></a></li>-->
							</ul>
							<!--/ social-icons -->

							<!-- copyright -->
							<div class="copyright">
								<a href="index.html">
									
								</a>
								<p>© 2017 All rights reserved. <a href="<?php echo e(URL::to('/register')); ?>">smilesteadily.com</a>.</p>
							</div>
							<!--/ copyright -->
						</div>
						<!--/ bottom -->
					</div>
					<!--/ col-sm-12 -->
				</div>
				<!--/ row -->
			</div>
			<!--/ container -->
		</footer>
		<!--/ Footer - Default Style -->
	</div>
	<!--/ Page Wrapper -->


	<?php if(!Auth::check()): ?>

	<?php if(isset($errors)): ?>

	<!-- Login Panel content -->
	<div id="login_panel" class="mfp-hide loginbox-popup auth-popup">
		<div class="inner-container login-panel auth-popup-panel">
			<h3 class="m_title m_title_ext text-custom auth-popup-title tcolor">Login to your dashboard</h3>
			<form class="login_panel" name="login_form" method="POST" action="<?php echo e(route('login')); ?>">
			  <?php echo e(csrf_field()); ?>

				<div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?> kl-fancy-form">
					<input type="tel" id="kl-username" name="phone" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="08078786756" value="<?php echo e(old('phone')); ?>">
					<label class="kl-font-alt kl-fancy-form-label">Phone</label>
					 <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
				</div>


				<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> kl-fancy-form">
					<input type="password" id="kl-password" name="password" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="type password" value="<?php echo e(old('password')); ?>">
					<label class="kl-font-alt kl-fancy-form-label">PASSWORD</label>
					 <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
				</div>


				<label class="auth-popup-remember" for="kl-rememberme"><input type="checkbox" name="rememberme" id="kl-rememberme" value="forever" class="auth-popup-remember-chb"> Remember Me </label>
				<input type="submit" id="login" name="submit_button" class="btn zn_sub_button btn-fullcolor btn-md" value="LOG IN">

				<!--<div class="links auth-popup-links">
					<a href="#register_panel" class="create_account auth-popup-createacc kl-login-box auth-popup-link">create an account</a><span class="sep auth-popup-sep"></span><a href="#forgot_panel" class="kl-login-box auth-popup-link">Forgot your password?</a>
				</div>-->

			</form>
		</div>
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	</div>
	<div id="register_panel" class="mfp-hide loginbox-popup auth-popup">
		<div class="inner-container register-panel auth-popup-panel">
			<h3 class="m_title m_title_ext text-custom auth-popup-title">Create <strong>your account</strong> now</h3>
			<form class="register_panel" name="login_form" method="POST" action="<?php echo e(route('register')); ?>">
			<?php echo e(csrf_field()); ?>


			<?php if(isset($referer_phone)): ?>
			<input type="hidden" name="referer_phone" value="<?php echo e($referer_phone); ?>">
			<?php endif; ?>


				<div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?> kl-fancy-form">
					<input type="tel" id="kl-username" name="phone" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="08078786756" value="<?php echo e(old('phone')); ?>">
					<label class="kl-font-alt kl-fancy-form-label">Phone</label>
					 <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
				</div>

				<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> kl-fancy-form">
					<input type="text" id="kl-username" name="email" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="johndoe@gmail.com" value="<?php echo e(old('email')); ?>">
					<label class="kl-font-alt kl-fancy-form-label">Email</label>
					 <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
				</div>

				<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> kl-fancy-form">
					<input type="password" id="kl-username" name="password" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="Your password" value="<?php echo e(old('password')); ?>">
					<label class="kl-font-alt kl-fancy-form-label">Password</label>
					 <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
				</div>


				
				
				<div class="form-group kl-fancy-form">
					<input type="password" id="reg-pass2" name="password_confirmation" class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="*****"><label class="kl-font-alt kl-fancy-form-label">VERIFY PASSWORD</label>
				</div>
				<div class="form-group">
					<input type="submit" id="signup" name="submit" class="btn zn_sub_button btn-block btn-fullcolor btn-md" value="CREATE MY ACCOUNT">
				</div>
				<div class="links auth-popup-links">
					<a href="#login_panel" class="kl-login-box auth-popup-link">ALREADY HAVE AN ACCOUNT?</a>
				</div>
			</form>
		</div>
	</div>
	<div id="forgot_panel" class="mfp-hide loginbox-popup auth-popup forgot-popup">
		<div class="inner-container forgot-panel auth-popup-panel">
			<h3 class="m_title m_title_ext text-custom auth-popup-title">FORGOT YOUR DETAILS?</h3>




			<form class="forgot_form" name="login_form" method="POST" action="<?php echo e(URL::to('/passwords/reset')); ?>">


			 <h4>Enter your phone number below.</h4>
                                                 <?php echo e(csrf_field()); ?>


				<div class="form-group <?php echo e($errors->has('phone') ? ' has-error' : ''); ?> kl-fancy-form">


					<input name="phone" type="tel" value="<?php echo e(old('phone')); ?>"" id="forgot-phone"  class="form-control inputbox kl-fancy-form-input kl-fw-input" placeholder="08078867768">

					 <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>

                       <?php endif; ?>


					<label class="kl-font-alt kl-fancy-form-label">PHONE NUMBER</label>
				</div>

				<div class="form-group">


					<input type="submit" id="recover" name="submit" class="btn btn-block zn_sub_button btn-fullcolor btn-md" value="SUBMIT">
				</div>

				<div class="links auth-popup-links">
					<a href="#login_panel" class="kl-login-box auth-popup-link">I REMEMBER NOW!</a>
				</div>
			</form>
		</div>
		<button title="Close (Esc)" type="button" class="mfp-close">×</button>
	</div>
	<!--/ Login Panel content -->
	<?php endif; ?>
	<?php endif; ?>

	<!-- ToTop trigger -->
	<a href="#" id="totop">TOP</a>
	<!--/ ToTop trigger -->


	


	<!-- JS FILES // These should be loaded in every page -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/bootstrap.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/kl-plugins.js')); ?>"></script>

	<!-- JS FILES // Loaded on this page -->
	<!-- Requried js script for Slideshow Scroll effect -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/plugins/scrollme/jquery.scrollme.js')); ?>"></script>

	
	<!-- Custom Smilesteadily JS codes -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/kl-scripts.js')); ?>"></script>

	<!-- Demo panel -->
	<script type="text/javascript" src="<?php echo e(asset('public/pages/js/dp.js')); ?>"></script>


	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/595d66b8e9c6d324a473900b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

<!-- Mirrored from demos.hogash.com/Smilesteadily_template/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 07 Jul 2017 10:12:11 GMT -->
</html>

