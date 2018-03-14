<!doctype html>
<html>


<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Feb 2017 16:54:12 GMT -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>Expocash- Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset('/public/css/bootstrap.min.css')}}">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/jquery-ui/jquery-ui.min.css')}}">
	<!-- PageGuide -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/pageguide/pageguide.css')}}">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/fullcalendar/fullcalendar.css')}}">
	<link rel="stylesheet" href="{{asset('/public/css/plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
	<!-- chosen -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/chosen/chosen.css')}}">
	<!-- select2 -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/select2/select2.css')}}">
	<!-- icheck -->
	<link rel="stylesheet" href="{{asset('/public/css/plugins/icheck/all.css')}}">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="{{asset('/public/css/style.css')}}">
	<!-- Color CSS -->
	<link rel="stylesheet" href="{{asset('/public/css/themes.css')}}">

	<!-- jQuery -->
	<script src="{{asset('/public/js/jquery.min.js')}}"></script>


	<!-- Nice Scroll -->
	<script src="{{asset('/public/js/plugins/nicescroll/jquery.nicescroll.min.js')}}"></script>
	<!-- jQuery UI -->
	<script src="{{asset('/public/js/plugins/jquery-ui/jquery-ui.js')}}"></script>
	<!-- Touch enable for jquery UI -->
	<script src="{{asset('/public/js/plugins/touch-punch/jquery.touch-punch.min.js')}}"></script>
	<!-- slimScroll -->
	<script src="{{asset('/public/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('/public/js/bootstrap.min.js')}}"></script>
	<!-- vmap -->
	<script src="{{asset('/public/js/plugins/vmap/jquery.vmap.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/vmap/jquery.vmap.world.js')}}"></script>
	<script src="{{asset('/public/js/plugins/vmap/jquery.vmap.sampledata.js')}}"></script>
	<!-- Bootbox -->
	<script src="{{asset('/public/js/plugins/bootbox/jquery.bootbox.js')}}"></script>
	<!-- Flot -->
	<script src="{{asset('/public/js/plugins/flot/jquery.flot.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/flot/jquery.flot.bar.order.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/flot/jquery.flot.pie.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/flot/jquery.flot.resize.min.js')}}"></script>
	<!-- imagesLoaded -->
	<script src="{{asset('/public/js/plugins/imagesLoaded/jquery.imagesloaded.min.js')}}"></script>
	<!-- PageGuide -->
	<script src="{{asset('/public/js/plugins/pageguide/jquery.pageguide.js')}}"></script>
	<!-- FullCalendar -->
	<script src="{{asset('/public/js/plugins/fullcalendar/moment.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
	<!-- Chosen -->
	<script src="{{asset('/public/js/plugins/chosen/chosen.jquery.min.js')}}"></script>
	<!-- select2 -->
	<script src="{{asset('/public/js/plugins/select2/select2.min.js')}}"></script>
	<!-- icheck -->
	<script src="{{asset('/public/js/plugins/icheck/jquery.icheck.min.js')}}"></script>

	<!-- Theme framework -->
	<script src="{{asset('/public/js/eakroko.min.js')}}"></script>
	<!-- Theme scripts -->
	<script src="{{asset('/public/js/application.min.js')}}"></script>
	<!-- Just for demonstration -->
	<script src="{{asset('/public/js/demonstration.min.js')}}"></script>

 <!--dataTable-->
	<script src="{{asset('/public/js/plugins/momentjs/jquery.moment.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/momentjs/moment-range.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/datatables/extensions/dataTables.tableTools.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/datatables/extensions/dataTables.colReorder.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/datatables/extensions/dataTables.colVis.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/datatables/extensions/dataTables.scroller.min.js')}}"></script>

	<!-- complexify -->
	<script src="{{asset('/public/js/plugins/complexify/jquery.complexify-banlist.min.js')}}"></script>
	<script src="{{asset('/public/js/plugins/complexify/jquery.complexify.min.js')}}"></script>
	<!-- Mockjax -->
	<script src="{{asset('/public/js/plugins/mockjax/jquery.mockjax.js')}}"></script>


	<!--[if lte IE 9]>
		<script src="{{asset('/public/js/plugins/placeholder/jquery.placeholder.min.js')}}"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
		<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{asset('/public/img/favicon.ico')}}" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="{{asset('/public/img/apple-touch-icon-precomposed.png')}}" />
</head>

<body>



	<div id="new-task" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">Add new task</h4>
				</div>
				<form action="#" class='new-task-form form-horizontal form-bordered'>
					<div class="modal-body nopadding">
						<div class="form-group">
							<label for="tasktitel" class="col-sm-3 control-label">Icon</label>
							<div class="col-sm-9">
								
							</div>
						</div>
						<div class="form-group">
							<label for="task-name" class="col-sm-3 control-label">Task</label>
							<div class="col-sm-9">
								<input type="text" name="task-name">
							</div>
						</div>
						<div class="form-group">
							<label for="tasktitel" class="col-sm-3 control-label"></label>
							<div class="col-sm-9">
								<label class="checkbox">
									<input type="checkbox" name="task-bookmarked" value="yep">Mark as important</label>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Add task">
					</div>
				</form>
			</div>
		</div>
	</div>






	<div id="navigation">
		<div class="container-fluid">
			<a href="{{URL::to('/admin/home')}}" id="brand">Expocash</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="{{URL::to('/admin/home')}}">
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/users')}}">
						<span>Registered users</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/inbox')}}">
						<span>Inbox</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/requests/ph')}}">
						<span>PH requests</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/requests/gh')}}">
						<span>GH request</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/matchlist')}}">
						<span>Match list</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/fakereceipt')}}">
						<span>Fake receipt</span>
					</a>
				</li>

				<li class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Site admin
						
					</a>
					<ul class="dropdown-menu pull-right">
						
						<li>
							<b>{{Auth::guard('admin')->user()->username}}</b>
							&comma; level {{Auth::guard('admin')->user()->role}}
						</li>

						@if(Auth::guard('admin')->user()->role=='1')
						<li>
							<a href="{{URL::to('/admin/register')}}">
								Add new administrator
							</a>
						</li>

						<li>
							<a  class='btn btn-danger' href="{{URL::to('/admin/matchlist/blocktimedeclindedusers')}}">Block time declined users (all)</a>
						</li>

						@endif


						

						<li>
							<a href="{{url::to('/admin/logout')}}">Logout</a>
						</li>
					</ul>
				</li>

				</ul>

				


			</div>
		</div>
	</div>
	<div class="container-fluid" id="content">
		<div id="left">
			
			<div class="subnav">
				<div class="subnav-title">
					<a href="dashboard.php" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Navigation</span>
					</a>
				</div>

				<ul class="subnav-menu">
					
					<li class='active'>
					<a href="{{URL::to('/admin/dashboard')}}">
						<span>Dashboard</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/users')}}">
						<span>Registered users</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/inbox')}}">
						<span>Inbox</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/requests/ph')}}">
						<span>PH requests</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/requests/gh')}}">
						<span>GH request</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/matchlist')}}">
						<span>Match list</span>
					</a>
				</li>

				<li>
					<a href="{{URL::to('/admin/fakereceipt')}}">
						<span>Fake receipt</span>
					</a>
				</li>

				<li class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Site admin
						
					</a>
					<ul class="dropdown-menu pull-right">
						
						<li>
							<b>{{Auth::guard('admin')->user()->username}}</b>
							&comma; level {{Auth::guard('admin')->user()->role}}
						</li>

						@if(Auth::guard('admin')->user()->role=='1')
						<li>
							<a href="{{url::to('/admin/register')}}">
								Add new administrator
							</a>
						</li>
						@endif

						<li>
							<a href="{{url::to('/admin/logout')}}">Logout</a>
						</li>
					</ul>
				</li>


				</ul>
			</div>


			
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
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js')}}';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
	</script>
</body>


<!-- Mirrored from www.eakroko.de/flat/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Feb 2017 16:55:52 GMT -->
</html>
