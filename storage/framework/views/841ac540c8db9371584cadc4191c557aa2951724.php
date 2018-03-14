<?php $__env->startSection('content'); ?>
		



<div role="main" class="main">

	<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Testimonies</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Testimonies</h1>
							</div>
						</div>
					</div>
				</section>

				<div class="container">
				<div class="row">



					<?php $__currentLoopData = $approvedTestimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


						<div class="col-lg-6">
							<div class="testimonial testimonial-primary">
								<blockquote>
									<p> <?php echo e($testimony->message); ?></p>
								</blockquote>
								<div class="testimonial-arrow-down"></div>
								<div class="testimonial-author">
									<div class="testimonial-author-thumbnail img-thumbnail">
										<img src="img/clients/client-1.jpg" alt="">
									</div>
									<p>
										<strong><?php echo e($testimony->user->name); ?></strong>
										<span>
											<?php echo e(date('F d, Y', strtotime($testimony->updated_at))); ?>&nbsp;|&nbsp;
          <?php echo e(date('h:i',strtotime($testimony->updated_at))); ?>

      </span>
									</p>
								</div>
							</div>
						</div>


						 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



					</div>





					<!--pagination-->

					<div>
						
					<?php echo e($approvedTestimonies->links()); ?>

						
					</div>
					<!--pagination-->



				</div>

			</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>