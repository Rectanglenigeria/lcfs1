
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        NEWS
       
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
          <ul class="timeline">

          <?php $__currentLoopData = $newsfeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo e(date('F d, Y', strtotime($news->updated_at))); ?>

                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('h:i',strtotime($news->updated_at))); ?></span>

                <h1 class="timeline-header"><a class="h3">Title: <?php echo e($news->title); ?></a></h1>

                <div class="timeline-body h4" style="line-height: 40px;">
                   <?php echo e(substr($news->body, 0, 250)); ?>

                   <?php if(strlen($news->body)<=250): ?>
                   <?php echo e('.'); ?>

                   <?php else: ?>
                   <?php echo e('...'); ?>

                   <?php endif; ?>
                </div>
                <div class="timeline-footer">
                <?php if(strlen($news->body)<=250): ?>
                   <?php echo e(null); ?>

                   <?php else: ?>
                  <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/news/view/'.$news->id)); ?>">Read more</a>
                  <?php endif; ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




            </ul>
            <!-- timeline item -->
            <center>
              <?php echo e($newsfeeds->links()); ?>

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