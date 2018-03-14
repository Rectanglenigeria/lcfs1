;

<?php $__env->startSection('content'); ?>
		<!-- Google maps element -->
		<div class="hidden-sm hidden-xs">
			
		<br><br>
		</div>
		<!--/ Google maps element -->

		<!-- Contact form & details section -->
		<section class="hg_section ptop-80 pbottom-80">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<!-- Contact form -->
						<div class="contactForm">


							<?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>



							<form action="<?php echo e(URL::to('/contact_message/send')); ?>" method="post" class="contact_form row" enctype="multipart/form-data">

							  <?php echo e(csrf_field()); ?>


								<div class="cf_response"></div>

								<p class="col-sm-6 kl-fancy-form <?php echo e($errors->has('firstname') ? ' has-error' : ''); ?>">
									<input type="text" name="firstname" id="cf_name" class="form-control" placeholder="Please enter your first name" value="<?php echo e(old('firstname')); ?>" tabindex="1" maxlength="35" required>

									<?php if($errors->has('firstname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('firstname')); ?></strong>
                                    </span>
                                    <?php endif; ?>

									<label class="control-label">FIRSTNAME</label>
								</p>

								<p class="col-sm-6 kl-fancy-form <?php echo e($errors->has('lastname') ? ' has-error' : ''); ?>">
									<input type="text" name="lastname" id="cf_lastname" class="form-control" placeholder="Please enter your first last name" value="<?php echo e(old('lastname')); ?>" tabindex="1" maxlength="35" required>

									<?php if($errors->has('lastname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('lastname')); ?></strong>
                                    </span>
                                    <?php endif; ?>


									<label class="control-label">LASTNAME</label>
								</p>
								<p class="col-sm-12 kl-fancy-form <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
									<input type="text" name="email" id="cf_email" class="form-control h5-email" placeholder="Please enter your email address" value="<?php echo e(old('email')); ?>" tabindex="1" maxlength="35" required>
									<?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>

									<label class="control-label">EMAIL</label>
								</p>
								<p class="col-sm-12 kl-fancy-form <?php echo e($errors->has('subject') ? ' has-error' : ''); ?>">
									<input type="text" name="subject" id="cf_subject" class="form-control" placeholder="Enter the subject message" value="<?php echo e(old('subject')); ?>" tabindex="1" maxlength="35" required>

									<?php if($errors->has('subject')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('subject')); ?></strong>
                                    </span>
                                    <?php endif; ?>

									<label class="control-label">SUBJECT</label>
								</p>
								<p class="col-sm-12 kl-fancy-form <?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
									<textarea name="message" id="cf_message" class="form-control" cols="30" rows="10" placeholder="Your message" tabindex="4" required>
										<?php echo e(old('message')); ?>

									</textarea>

									<?php if($errors->has('message')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                    </span>

                                    <?php endif; ?>

									<label class="control-label">MESSAGE</label>
								</p>

								<p class="col-sm-12">
									<label for='uploaded_file'>Select A File To Upload:</label>
									<input type="file" id="uploaded_file" name="attachment">


									<?php if($errors->has('file')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('file')); ?></strong>
                                    </span>

                                    <?php endif; ?>

								</p>

						

								<p class="col-sm-12">
									<button class="btn btn-fullcolor js-button-cf-submit" type="submit">Send</button>
								</p>
								
							</form>







						</div>
						<!--/ Contact form -->
					</div>
					<!--/ col-md-9 col-sm-9 -->

					<div class="col-md-3 col-sm-3">
						<!-- Contact details -->
						<div class="text_box">
							<h3 class="text_box-title text_box-title--style2">CONTACT INFO</h3>
							<h4>Smilesteadily</h4>
							<p>
								<a href="mailto:admin@smilesteadily.com">admin@smilesteadily.com</a><br>
								<a href="http://www.smilesteadily.com/">www.smilesteadily.com</a>
							</p>
						</div>
						<!--/ Contact details -->
					</div>
					<!--/ col-md-3 col-sm-3 -->
				</div>
				<!--/ .row -->
			</div>
			<!--/ .container -->
		</section>
		<!--/ Contact form & details section -->

     <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>