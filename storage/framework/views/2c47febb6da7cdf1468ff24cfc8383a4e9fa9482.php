<?php if(Auth::check()): ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Smilesteadily | User Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/dist/css/AdminLTE.min.css')); ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/dist/css/skins/_all-skins.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/iCheck/flat/blue.css')); ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/morris/morris.css')); ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/jvectormap/jquery-jvectormap-1.2.2.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/datepicker/datepicker3.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('public/auth_pages/plugins/datatables/dataTables.bootstrap.css')); ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
    
    .color-palette {
      color: #fff;
      margin-left: 5px;
    }
  </style>
</head>
<?php 
if((Auth::user()->is_pioneer=='1' && Auth::user()->is_teamlead=='1') ){
$skin='black';
$title='Pioneer | Team Lead';

}elseif(Auth::user()->is_pioneer == '1'){
  $skin='blue';
  $title='Pioneer';
}elseif(Auth::user()->is_teamlead == '1'){
  $skin='purple';
  $title='Team Lead';
}else{
  $skin='red';
  $title='Smilesteadily';
}


  ?>


<body class="hold-transition skin-<?php echo e($skin); ?> sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo e($title); ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo e($title); ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo e(asset('public/auth_pages/dist/img/avatar.png')); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo e(Auth::user()->email); ?></span>
            </a> 
          
          </li>
          <!-- Control Sidebar Toggle Button -->
          <!-- ############## changes made ################### -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo e(asset('public/auth_pages/dist/img/avatar.png')); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left bg-light-white color-palette">
          <p>Phone:&nbsp;<?php echo e(Auth::user()->phone); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          <form method="post" action="<?php echo e(route('logout')); ?>">
           <?php echo e(csrf_field()); ?>

            <button name="logout" type="submit" class="btn btn-sm btn-danger">Logout</button>
          </form>
          <!--<a href="<?php echo e(route('logout')); ?>"><i class="fa fa-power"></i>Logout</a>-->
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class=" treeview">
          <a href="<?php echo e(URL::to('/dashboard')); ?>">
            <i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
          </a>
        </li>

        <li class=" treeview">
          <a href="<?php echo e(URL::to('/user_profile')); ?>">
            <i class="fa fa-user"></i>
              <span>Profile</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>
        
        <li class=" treeview">
          <a href="<?php echo e(URL::to('/gsmile/create')); ?>">
            <i class="fa fa-upload"></i>
              <span>Give Smiles</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="<?php echo e(URL::to('/rsmile/create')); ?>">
            <i class="fa fa-download"></i>
              <span>Receive Smiles</span>
          </a>
        </li>

        <li class=" treeview">
          <a href="<?php echo e(URL::to('/wallet/view/')); ?>">
            <i class="fa fa-briefcase"></i>
              <span>My Wallet</span>
          </a>
        </li>

        
        <li class=" treeview">
          <a href="<?php echo e(URL::to('/testimonials/create/')); ?>">
            <i class="fa fa-bullhorn"></i>
              <span>Testimony</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="<?php echo e(URL::to('bonus/list')); ?>">
            <i class="fa fa-money"></i>
              <span>Bonuses</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="<?php echo e(URL::to('/news/list')); ?>">
            <i class="fa fa-newspaper-o"></i>
              <span>News</span>
          </a>
        </li>
        <li class=" treeview">
          <a href="<?php echo e(route('logout')); ?>">
            <i class="fa fa-power-off"></i>
              <span>Log Out</span>
          </a>
        </li>
      </ul>

    </section>
    <!-- /.sidebar -->
  </aside>

  <?php echo $__env->yieldContent('content'); ?>

  <footer class="main-footer">
    
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://smilesteadily.com/">Smilesteadily</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(asset('public/auth_pages/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset('public/auth_pages/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo e(asset('public/auth_pages/plugins/morris/morris.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('public/auth_pages/plugins/sparkline/jquery.sparkline.min.js')); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo e(asset('public/auth_pages/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/auth_pages/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('public/auth_pages/plugins/knob/jquery.knob.js')); ?>"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo e(asset('public/auth_pages/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- datepicker -->
<script src="<?php echo e(asset('public/auth_pages/plugins/datepicker/bootstrap-datepicker.js')); ?>"></script>
<!-- Bootstrap WYSI5 -->
<script src="<?php echo e(asset('public/auth_pages/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<!-- DataTables -->
<!-- <script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script> -->
<!-- Slimscroll -->
<!-- <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
 --><!-- FastClick -->
<!-- <script src="plugins/fastclick/fastclick.js"></script>
 --><!-- AdminLTE App -->
<!-- <script src="dist/js/app.min.js"></script>
 --><!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script>
 --><!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script>
 -->
<script src="<?php echo e(asset('public/auth_pages/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(asset('public/auth_pages/bootstrap/js/bootstrap.min.js')); ?>"></script>
<!-- DataTables -->
<script src="<?php echo e(asset('public/auth_pages/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/auth_pages/plugins/datatables/dataTables.bootstrap.min.js')); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo e(asset('public/auth_pages/plugins/slimScroll/jquery.slimscroll.min.js')); ?>"></script>
<!-- FastClick -->
<script src="<?php echo e(asset('public/auth_pages/plugins/fastclick/fastclick.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('public/auth_pages/dist/js/app.min.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": true,
    });
    
  });
</script>


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


<!--McAfee security-->
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
<!--McAfee security-->



</body>
</html>

<?php endif; ?>
