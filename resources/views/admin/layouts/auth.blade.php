<!doctype html>
<html>


<!-- Mirrored from www.eakroko.de/flat/more-locked.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Feb 2017 17:05:29 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>Admin</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset('/public/css/bootstrap.min.css')}}">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('/public/css/style.css')}}">
	<!-- Color CSS -->
	<link rel="stylesheet" href="{{asset('/public/css/themes.css')}}">


	<!-- jQuery -->
	<script src="{{asset('/public/js/jquery.min.js')}}"></script>

	<!-- Nice Scroll -->
	<script src="{{asset('/public/js/plugins/nicescroll/jquery.nicescroll.min.')}}'"></script>
	<!-- Bootstrap -->
	<script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/public/js/eakroko.js')}}"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->


	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="{{asset('/public/img/apple-touch-icon-precomposed.png')}}" />

</head>

<body class='locked'>
	<div class="wrapper">
		<div class="pull-left">
			<!--<img src="img/demo/locked.jpg" alt="" width="200" height="200">-->
			
		</div>



		@yield('content')

		


	</div>
	<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-38620714-4']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
	</script>
</body>


<!-- Mirrored from www.eakroko.de/flat/more-locked.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Feb 2017 17:05:30 GMT -->
</html>
