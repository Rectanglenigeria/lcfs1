
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>User Blocked</small>
      </h1>
      
    </section>

    <section class="content">
  
     <?php if(Session::has('notification')): ?>
          <p class="alert alert-danger alert-sm alert-dismissable h4"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>



        
    <!-- Main content -->
    <section class="content">
      <p class="alert alert-info alert-sm alert-dismissable h4">
          
          <a class="label" href="<?php echo e(URL::to('/contact')); ?>">Contact</a> site adminitrator or chat with an online agent.

        </p>
        </section>



        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>