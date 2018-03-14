

<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;News</small>
      </h1>
         </section>


    
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->

        <div class="col-md-12">
          <!-- The time line -->


<?php if(!empty($news)): ?>
          <ul class="timeline">
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
                   <?php echo e($news->body); ?>

                   
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('/admin/news/delete/'.$news->id)); ?>">Delete</a>
                 
                </div>

                <div class="timeline-footer">
                  <a class="btn btn-success btn-xs" href="<?php echo e(URL::to('/admin/news/list')); ?>">Back</a>
                 
                </div>

                
              </div>
            </li>
            <!-- END timeline item -->
            </ul>
            <!-- timeline item -->
            <?php endif; ?>

              
        <!-- /.col -->
      </div>
        
                <!-- /.col -->

        </section>























		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>