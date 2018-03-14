<?php $__env->startSection('content'); ?>
<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Verification</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Account Verification</h1>
							</div>

						</div>
					</div>
				</section>

				<div class="container">

					<div class="row">
						<div class="col">

							<div class="featured-boxes">
								<div class="row">

									<div class="col-md-3 col-lg-3">
									</div>

									<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
										<div class="featured-box featured-box-primary text-left mt-5">
											<div class="box-content">
												<h4 class="heading-primary text-uppercase mb-3">Enter code</h4>
												<p>An account verification code has been sent to your phone. Enter the code to continue.</p>
												  <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


                                        <form name="sms_ver_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="<?php echo e(URL::to('/activate_user')); ?>">
                                                 <?php echo e(csrf_field()); ?>


                                            <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-12 control-label" for="user_login">Code</label>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="user_id" value="<?php echo e($user_id); ?>">
                                                    <input name="code" type="text" value="<?php echo e(old('code')); ?>" id="code" class="form-control inputbox" required="" placeholder="56453" autofocus>
                                                    <?php if($errors->has('code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="btn btn-sm btn-primary" value="Verify">
                                                    <a href="<?php echo e(URL::to('/reVerify/'.$user_id)); ?>" class="btn btn-sm btn-default">
                                                        Resend code
                                                    </a>
                                                </div>
                                                
                                                      
                                          </div>
                                        </form>
											</div>
										</div>
									</div>


									<div class="col-md-3 col-lg-3">
										
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>

			</div>


			<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>