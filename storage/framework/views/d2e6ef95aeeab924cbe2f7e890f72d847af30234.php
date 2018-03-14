<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Inbox</small>
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
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo e(date('F d, Y', strtotime($message->updated_at))); ?>

                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('h:i',strtotime($message->updated_at))); ?></span>
                <hr><hr>
<div style="margin-left:15px; ">
  <h4>Sender's Name: <?php echo e($message->name); ?></h4>
  <h4>Sender's Email: <?php echo e($message->email); ?></h4>
  <h4>Message Type: <label class="label label-info">
   <?php if($message->type == 1): ?>
  <?php echo e('Contact message'); ?>

  <?php elseif($message->type == 3): ?>
  <?php echo e('Fake teller message'); ?>

  <?php elseif($message->type == 2): ?>
  <?php echo e('Blockage message'); ?>

  <?php else: ?>
  <?php echo e(null); ?>

  <?php endif; ?>
  </label>
  </h4>
</div>
                

                <h1 class="timeline-header"><a class="h3">Title: <?php echo e($message->title); ?></a></h1>

                <div class="timeline-body h4" style="line-height: 40px;">
                <h3><b>Message : </b></h3>
                   <?php echo e($message->body); ?>

                   
                </div>

                <div style="margin-left: 15px;">
                  
                  <?php if($message->attachment != '0'): ?>
                    <a class="btn btn-primary" href="<?php echo e(asset('/public/uploads/'.$message->attachment_link)); ?>" target="_blank">View attachment</a>
                <?php endif; ?>
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-danger btn-xs" href="<?php echo e(URL::to('/admin/message/list')); ?>">Back</a>
                 
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            </ul>
            <!-- timeline item -->
            

              
        <!-- /.col -->
      </div>
        
                <!-- /.col -->

        </section>























		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>