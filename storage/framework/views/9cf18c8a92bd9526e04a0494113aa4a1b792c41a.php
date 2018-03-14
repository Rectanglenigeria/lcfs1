<?php $__env->startSection('content'); ?>




<div class="login-box">
  <div class="register-logo">
    <a><b>Admin login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="<?php echo e(URL::to('/admin/login')); ?>" method='POST'>

    <?php echo e(csrf_field()); ?>


    <?php if(Session::has('notification')): ?>
                          <p class="alert alert-danger alert-sm"><?php echo e(Session::get('notification')); ?></p>

                        <?php endif; ?>


      <div class="form-group has-feedback">
      <?php if($errors->has('username')): ?> <p class="alert alert-danger alert-sm">
      <?php echo e($errors->first('username')); ?></p>
      <?php endif; ?>
                  	
        <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo e(old('username')); ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>



      <div class="form-group has-feedback">

      <?php if($errors->has('password')): ?> <p class="alert alert-danger alert-sm">
      <?php echo e($errors->first('password')); ?></p>
      <?php endif; ?>
                  
        <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo e(old('password')); ?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>


      <div class="row">
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>