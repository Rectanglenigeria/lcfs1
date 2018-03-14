<?php $__env->startSection('content'); ?>


<div role="main" class="main">

				<section class="page-header">
					<div class="container">
						<div class="row">
							<div class="col">
								<ul class="breadcrumb">
									<li><a href="index.html">Home</a></li>
									<li class="active">Login</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<h1>Login</h1>
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

												 <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


      

												
												<form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="<?php echo e(route('login')); ?>">

													<?php echo e(csrf_field()); ?>

<?php

    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP'])){
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else if(isset($_SERVER['HTTP_X_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    }
    else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    else if(isset($_SERVER['HTTP_FORWARDED'])){
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    }
    else if(isset($_SERVER['REMOTE_ADDR'])){
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    }
    else{
        $ipaddress = 'UNKNOWN';
    }

?>

													<div class="form-row">
														<div class="form-group col">
															<label>IP Address</label>
															<input type="text" value="<?php echo e($ipaddress); ?>" class="form-control form-control-lg" disabled="disabled">
														</div>
													</div>

													<div class="form-row">
														<div class="form-group col<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
															<label>Phone No</label>
															<input type="number" value="<?php echo e(old('phone')); ?>" class="form-control form-control-lg" placeholder="08123434565" name="phone" >


															 <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													</div>

													
													<div class="form-row">
														<div class="form-group col<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
															<a class="float-right" href="<?php echo e(URL::to('/passwords/reset')); ?>">(Lost Password?)</a>
															<label>Password</label>
															<input type="password" value="<?php echo e(old('password')); ?>" class="form-control form-control-lg" name="password">
															    <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-lg-6">
															<div class="form-check form-check-inline">
																<label class="form-check-label">
																	<input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
																</label>
															</div>
														</div>
														<div class="form-group col-lg-6">
															<input type="submit" value="Login" class="btn btn-primary float-right mb-5" data-loading-text="Loading...">
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