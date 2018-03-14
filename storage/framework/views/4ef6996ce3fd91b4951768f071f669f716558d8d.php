;

<?php $__env->startSection('content'); ?>
		<!-- Google maps element -->
		<div class="hidden-sm hidden-xs">
      
    <br><br>
    </div>
    <!--/ G
      
		<!--/ Google maps element -->

		<!-- Contact form & details section -->
		<section class="hg_section ptop-80 pbottom-80">
			<div class="container">
				<div class="row">
				<ol class="breadcrumb">
  <li><a href="<?php echo e(URL::to('/register')); ?>">Home</a></li>
  <li><a href="<?php echo e(URL::to('/testimonial')); ?>">Testimonies</a></li>
</ol>

  <!--testimonials-->


  	<?php $__currentLoopData = $approvedTestimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-md-4">
            <div class="thumbnail">
            <?php if($testimony->has_video != null && $testimony->has_video != '0'): ?>

            <iframe style="width:100%; height: 180px;" src="<?php echo e($testimony->video_link); ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen controls>
            </iframe>

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
        <p><a href="<?php echo e(URL::to('/testimonial/view/'.$testimony->id)); ?>" class="btn btn-danger btn-sm" role="button">View</a> </p>
      </div>
    </div>
    </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		  <!--testimonials-->


					<!--/ col-md-9 col-sm-9 -->

				</div>

				 <center>
              <?php echo e($approvedTestimonies->links()); ?>

            </center>
				<!--/ .row -->
			</div>
			<!--/ .container -->
		</section>
		<!--/ Contact form & details section -->

     <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>