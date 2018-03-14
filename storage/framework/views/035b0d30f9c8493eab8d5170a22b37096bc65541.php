<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Testimonials / list
       
      </h1>
      
    </section>

    <section class="content">
      <!--refereer link-->
          
        <!--refereer link-->
     <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>

       <!-- <div class="callout callout-info">
            
                <center><a href="givesmiles.php"><button type="button" class="btn bg-olive btn-flat margin">Give Smiles</button></a>
              
                <a href="receivesmiles.php"><button type="button" class="btn bg-red btn-flat margin">Receive Smiles</button></a></center>
              
        </div>-->

    <!-- Main content -->
<section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->

        <div class="col-md-12">
          <!-- The time line -->
          <div class="row">

          <?php $__currentLoopData = $approvedTestimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

           <?php
                  if(!isset($testimony->user->name)){continue;}
                ?>

            <div class="col-md-4">
            <div class="thumbnail">
            <?php if($testimony->has_video != null && $testimony->has_video != '0'): ?>

<?php

     $rawLink=$testimony->video_link;
     $explodedLink=explode('watch?v=', $rawLink);
     $implodedLink=implode('embed/', $explodedLink);
?>
   

          <iframe style="width:100%; height: 180px;" src="<?php echo e($implodedLink); ?>" frameborder="0" allowfullscreen></iframe>

           

       <!--<video controls poster="" width="350">
          <source src="<?php echo e($testimony->video_link); ?>" type="video/mp4">
            Your browser does not support HTML5 video.
    </video>-->
        <?php else: ?>

        <img src="<?php echo e(asset('public/videos/placeholderImage.png')); ?>" style="width:100%;height: 180px">

        <?php endif; ?>


      <div class="caption">
        <span style="float:left;">
          <?php echo e(date('F d, Y', strtotime($testimony->updated_at))); ?>&nbsp;|&nbsp;
          <?php echo e(date('h:i',strtotime($testimony->updated_at))); ?>

        </span>
        <hr>
        <h3><?php echo e($testimony->user->name); ?></h3>
        <p style="line-height:25px;"><?php echo e(substr($testimony->message,0,65)); ?></p>
        <p><a href="<?php echo e(URL::to('/testimonials/view/'.$testimony->id)); ?>" class="btn btn-danger btn-sm" role="button">view</a> </p>
      </div>
    </div>
    </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>
            <!-- timeline item -->
            <center>
              <?php echo e($approvedTestimonies->links()); ?>

            </center>
            
              
        <!-- /.col -->
           
      </div>
        
                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>