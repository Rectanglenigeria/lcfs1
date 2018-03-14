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

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
           
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><span><i class="fa fa-inbox"></i> All achieved news</span></li>
            </ul>
           
          </div>

           
<div>
   <a href="<?php echo e(URL::to('/admin/news/create')); ?>" class="btn btn btn-success">Create news</a>
</div>
<br>

           <div>

 

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

                   <?php if(strlen($news->body)==250): ?>
                   <?php echo e('.'); ?>

                   <?php else: ?>
                   <?php echo e('...'); ?>

                   <?php endif; ?>
                </div>
                <div class="timeline-footer">
                <?php if(strlen($news->body)==250): ?>
                   <?php echo e(null); ?>

                   <?php else: ?>
                  <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('admin/news/view/'.$news->id)); ?>">Read more</a>
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