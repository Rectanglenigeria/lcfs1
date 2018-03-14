<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Testimonies</small>
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
        <section class="col-lg-12 connectedSortable">

  
        
         

<div class="row">
            <div class="col-md-6">

            
            <div class="thumbnail">
         <?php if($testimony->has_video != null && $testimony->has_video != '0'): ?>

            <iframe style="width:100%;height: 450px" src="<?php echo e($testimony->video_link); ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen>
            </iframe>

       <!--<video controls poster="" width="350">
          <source src="<?php echo e($testimony->video_link); ?>" type="video/mp4">
            Your browser does not support HTML5 video.
    </video>-->
        <?php else: ?>

        <img src="<?php echo e(asset('public/videos/placeholderImage.png')); ?>" style="width:100%;height: 450px">

        <?php endif; ?>


      <div class="caption">
        <span style="float:left;">
          <?php echo e(date('F d, Y', strtotime($testimony->updated_at))); ?>&nbsp;|&nbsp;
          <?php echo e(date('h:i',strtotime($testimony->updated_at))); ?>

        </span>
        <hr>
        <h3><?php echo e($testimony->user->name); ?></h3>
        <p style="line-height: 40px;"><?php echo e($testimony->message); ?></p>

        <p>


        <?php if($testimony->has_approved == 1 || $testimony->has_approved == 2): ?>
          <?php echo e('Approved'); ?>

        <?php else: ?>
        <a href="<?php echo e(URL::to('admin/testimony/approve/'.$testimony->id)); ?>" class="btn btn-primary btn-sm" role="button">Approve</a> 
        <?php endif; ?>

         <?php if($testimony->has_approved == 2): ?>
          <?php echo e('| Approved video, granted 5%'); ?>


          <?php else: ?>
         <a href="<?php echo e(URL::to('admin/testimony/video/approve/'.$testimony->id)); ?>" class="btn btn-primary btn-sm" role="button">Approve video (5% bonus)
         </a>
         <?php endif; ?>

        </p>


      </div>
    </div>
    </div>
    </div>




        
          <!-- /.box -->


              
         
        </section>







        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
























		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>