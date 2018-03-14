<?php $__env->startSection('content'); ?>

   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;User | View</small>
      </h1>
         </section>


    <section class="content">


    <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-lg-2"></div>
        <section class="col-lg-6 connectedSortable">
        <a style="float: right;" href="<?php echo e(URL::to('/admin/user/list')); ?>" class="btn btn-success">Back</a>

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Name</strong>

              <p class="text-muted">
               <?php echo e($user->name); ?>

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Phone</strong>

              <p class="text-muted"><?php echo e($user->phone); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>

              <p class="text-muted"><?php echo e($user->email); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Account name</strong>

              <p class="text-muted"><?php echo e($user->account_name); ?></p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i> Account number</strong>

              <p class="text-muted"><?php echo e($user->account_no); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Bank</strong>

              <p class="text-muted"><?php echo e(ucwords($user->bank)); ?>&nbsp; Bank</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Referrer link</strong>

              <p class="text-muted"><?php echo e(($user->referer_link)); ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Tags</strong>

              <p>

              	<?php if($user->is_pioneer == '1'): ?>
                <span class="label label-primary"><?php echo e('Pioneer'); ?></span>
                <?php else: ?>
                <span class="label label-primary"><?php echo e('Ordinary user'); ?></span>
                <?php endif; ?>

                <?php if($user->is_active == '1'): ?>
                <span class="label label-success"><?php echo e('verified'); ?></span>
                <?php else: ?>
                <span class="label label-success"><?php echo e('not verified '); ?></span>
                <?php endif; ?>

                <?php if($user->is_pioneer == '1'): ?>
                <span class="label label-info"><?php echo e('blocked'); ?></span>
                <?php else: ?>
                <span class="label label-info"><?php echo e('active'); ?></span>
                <?php endif; ?>

                <!--<span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>-->
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>

              <?php if($user->is_pioneer == '0' || $user->is_pioneer == null): ?>
              <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/make_pioneer/'.$user->id)); ?>">Make pioneer</a>
               <?php else: ?>
               <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_pioneer/'.$user->id)); ?>">Unmake pioneer</a>
              <?php endif; ?>

              <?php if($user->is_block == '0' || $user->is_block == null): ?>
              <a class="btn btn-info" href="<?php echo e(URL::to('/admin/user/block/'.$user->id)); ?>">Block</a>
               <?php else: ?>
               <a class="btn btn-info" href="<?php echo e(URL::to('/admin/user/unblock/'.$user->id)); ?>">Unblock</a>
              <?php endif; ?>


              <a class="btn btn-danger" href="<?php echo e(URL::to('/admin/user/delete/'.$user->id)); ?>">
              delete</a>

              </p>
            </div>
            <!-- /.box-body -->
          </div>
         
        </section>

        <div class="col-lg-2"></div>







        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->





		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>