<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	
<!-- Mirrored from preview.oklerthemes.com/porto/6.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 07:06:10 GMT -->
<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<!-- Title -->
	@if(isset($ActiveTab))
	<title>{{ "Luaghter Community | ".ucwords($ActiveTab) }}</title>
	@else
	<title>{{ "Laughter Community" }}</title>
	@endif

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="{{asset('landing/img/favicon.ico')}}" type="image/x-icon" />
		<link rel="apple-touch-icon" href="{{asset('landing/img/apple-touch-icon.png')}}">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{{asset('landing/vendor/bootstrap/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/font-awesome/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/animate/animate.min.css')}}">
		<link rel="stylesheet" href="{{asset('vendor/simple-line-icons/css/simple-line-icons.min.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/owl.carousel/assets/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/owl.carousel/assets/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/magnific-popup/magnific-popup.min.css')}}">

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{asset('landing/css/theme.css')}}">
		<link rel="stylesheet" href="{{asset('landing/css/theme-elements.css')}}">
		<link rel="stylesheet" href="{{asset('landing/css/theme-blog.css')}}">
		<link rel="stylesheet" href="{{asset('landing/css/theme-shop.css')}}">

		<!-- Current Page CSS -->
		<link rel="stylesheet" href="{{asset('landing/vendor/rs-plugin/css/settings.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/rs-plugin/css/layers.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/rs-plugin/css/navigation.css')}}">
		<link rel="stylesheet" href="{{asset('landing/vendor/circle-flip-slideshow/css/component.css')}}">
		
		<!-- Demo CSS -->


		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{asset('landing/css/skins/default.css')}}">		<script src="{{asset('landing/master/style-switcher/style.switcher.localstorage.js')}}"></script> 

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{asset('landing/css/custom.css')}}">

		<!-- Head Libs -->
		<script src="{{asset('landing/vendor/modernizr/modernizr.min.js')}}"></script>

	</head>
	<body>
		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 55, 'stickySetTop': '-55px', 'stickyChangeLogo': true}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index-2.html">
											<img alt="Porto" width="54" height="54" data-sticky-width="40" data-sticky-height="40" data-sticky-top="30" src="{{asset('landing/img/logo.png')}}">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row pt-3">
									<nav class="header-nav-top">
										<ul class="nav nav-pills">
											<li class="nav-item d-none d-sm-block">
												<a class="nav-link" href="{{route('login')}}"><i class="fa fa-angle-right"></i>Log In</a>
											</li>
											<li class="nav-item d-none d-sm-block">
												<a class="nav-link" href="{{URL::to('/register')}}"><i class="fa fa-angle-right"></i> Sign Up</a>
											</li>
											<!--<li class="nav-item">
												<span class="ws-nowrap"><i class="fa fa-phone"></i> (123) 456-789</span>
											</li>-->
										</ul>
									</nav>
									
								</div>
								<div class="header-row">
									<div class="header-nav">
										<div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<li>
														<a class="dropdown-item dropdown-toggle active" href="{{URL::to('/register')}}">
															Home
														</a>
														
													</li>
													<li class="">
														<a class="nav-link" href="{{URL::to('/about')}}">
															About
														</a>
													</li>
													<li class="">
														<a class="nav-link" href="{{URL::to('/register#hiw')}}">
															How It Works?
														</a>
														
													</li>
													<li>
														<a class="nav-link" href="{{URL::to('/testimonial')}}">
															Testimonies
														</a>
													
														
													</li>
													<li class="dropdown">
														<a class="nav-link" href="{{URL::to('/contact')}}">
															Contact Us
														</a>
														
													</li>
													<li class="dropdown">
														<a class="nav-link" href="{{URL::to('/faqs')}}">
															FAQs
														</a>
														
													</li>
													
												</ul>
											</nav>
										</div>
										<ul class="header-social-icons social-icons d-none d-sm-block">
											<li class="social-icons-facebook"><a href="http://www.facebook.com/laughtercommunity" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
											<li class="social-icons-twitter"><a href="http://www.twitter.com/@laughtercommunity" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
											
										</ul>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fa fa-bars"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>








@yield('content')












 
		<footer class="short" id="footer">
				<div class="container">
					<div class="row">
						<div class="col-lg-9">
							<h4>About LC</h4>
							<p>This is a system where participant get 50% return on whatever sum donated to another participant in just 10 days... <a href="about.html" class="btn-flat btn-xs">View More <i class="fa fa-arrow-right"></i></a></p>
							<hr class="light">
							<div class="row">
								<div class="col-lg-3">									<ul class="list list-icons list-icons-sm">
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/register')}}">Home</a></li>
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/about')}}">About</a></li>
									</ul>
								</div>
								<div class="col-lg-3">
									<ul class="list list-icons list-icons-sm">
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/register#hiw')}}">How it works</a></li>
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/testimonial')}}">Testimonies</a></li>
									</ul>
								</div>
								<div class="col-lg-3">
									<ul class="list list-icons list-icons-sm">
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/contact')}}">Contact</a></li>
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/faqs')}}">FAQs</a></li>
									</ul>
								</div>
								<div class="col-lg-3">
									<ul class="list list-icons list-icons-sm">
										<!--<li><i class="fa fa-caret-right"></i> <a href="terms.html">Terms and Conditions</a></li>
										<li><i class="fa fa-caret-right"></i> <a href="policy.html">Privacy Policy</a></li>-->
										<li><i class="fa fa-caret-right"></i> <a href="{{URL::to('/register')}}">Create account</a></li>
										<li><i class="fa fa-caret-right"></i> <a href="{{route('login')}}">Login</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-3">
							<h5 class="mb-2">Contact Us</h5>
							<!--<span class="phone">(800) 123-4567</span>
							<p class="mb-0">International: (333) 456-6670</p>
							<p class="mb-0">Fax: (222) 531-8999</p>-->
							<ul class="list list-icons mt-4">
								<!--<li><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</li>-->
								<li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">info@laughtercommunity.com</a></li>
							</ul>
							<ul class="social-icons mt-4">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/laughtercommunity" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/laughtercommunity" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
								<!--<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
							</ul>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							
							<div class="col-lg-11">
								<p>© Copyright 2018. All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="{{asset('landing/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.appear/jquery.appear.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery-cookie/jquery-cookie.min.js')}}"></script>
		<script src="{{asset('landing/master/style-switcher/style.switcher.js')}}" id="styleSwitcherScript" data-base-path="" data-skin-src=""></script>
		<script src="{{asset('landing/vendor/popper/umd/popper.min.js')}}"></script>
		<script src="{{asset('landing/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('landing/vendor/common/common.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.validation/jquery.validation.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.gmap/jquery.gmap.min.js')}}"></script>
		<script src="{{asset('landing/vendor/jquery.lazyload/jquery.lazyload.min.js')}}"></script>
		<script src="{{asset('landing/vendor/isotope/jquery.isotope.min.js')}}"></script>
		<script src="{{asset('landing/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('landing/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
		<script src="{{asset('landing/vendor/vide/vide.min.js')}}"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="{{asset('landing/js/theme.js')}}"></script>
		
		<!-- Current Page Vendor and Views -->
		<script src="{{asset('landing/vendor/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>		<script src="{{asset('landing/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>		<script src="{{asset('landing/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js')}}"></script>		<script src="{{asset('landing/js/views/view.home.js')}}"></script>
		
		<!-- Theme Custom -->
		<script src="{{asset('landing/js/custom.js')}}"></script>
		
		<!-- Theme Initialization Files -->
		<script src="{{asset('landing/js/theme.init.js')}}"></script>

		<!-- Examples -->
		<script src="{{asset('landing/js/examples/examples.demos.js')}}"></script>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','http://www.google-analytics.com/analytics.js','ga');
		
			ga('create', 'UA-42715764-5', 'auto');
			ga('send', 'pageview');
		</script>
		<script src="{{asset('landing/master/analytics/analytics.js')}}"></script>

	</body>

<!-- Mirrored from preview.oklerthemes.com/porto/6.0.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2017 07:06:10 GMT -->
</html>