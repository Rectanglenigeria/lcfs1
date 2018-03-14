<?php $__env->startSection('content'); ?>
<!-- Slideshow - Static content Text with register + bottom mask style 3 -->
        <div class="kl-slideshow static-content__slideshow nobg maskcontainer--mask3 ">
            <div class="bgback">
            </div>

            <!-- Static content wrapper with custom height 820px = .h-820 -->
            <div class="kl-slideshow-inner static-content__wrapper static-content--height min-820">
                <!-- Static content background source -->
                <div class="static-content__source">
                    <!-- Background -->
                    <div class="kl-bg-source">
                        <!-- Background image -->
                        <div class="kl-bg-source__bgimage" style="background-image:url(<?php echo e(asset('public/pages/images/t3.jpg')); ?>); background-repeat:repeat; background-attachment:scroll; background-position-x:center; background-position-y:center; background-size:cover">
                        </div>
                        <!--/ Background image -->

                        <!-- Color overlay -->
                        <div class="kl-bg-source__overlay" style="background-color:rgba(0,0,0,0.2)">
                        </div>
                        <!--/ Color overlay -->
                    </div>
                    <!--/ Background -->

                    <!-- Animated Sparkles -->
                    <div class="th-sparkles"></div>
                    <!--/ Animated Sparkles -->
                </div>
                <!--/ .static-content__source -->

                <!-- Static content container -->
                <div class="static-content__inner container">
                    <!-- Container with safe padding custom top 230px -->
                    <div class="kl-slideshow-safepadding sc__container ptop-230">
                        <!-- Default style with login -->
                        <div class="static-content default-style static-content--with-login">
                            <div class="row">
                                <!-- Section left -->
                                <div class="col-md-4 col-lg-4">
                                   
                                </div>
                                <!--/ Section left col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0 -->

                                <!-- Section right -->
                                <div class="col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-0">
                                    <!-- Fancy register form -->
                                    <div class="fancy_register_form">
                                        <!-- Title centered -->
                                        
                                        <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>

                                        <form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="<?php echo e(URL::to('/passwords/verifyCode')); ?>">

                                        <h4>Enter code sent to your phone</h4>
                                                 <?php echo e(csrf_field()); ?>


                                                 <input type="hidden" name="code" value="<?php echo e($user_id); ?>">

                                            <div class="form-group<?php echo e($errors->has('code') ? ' has-error' : ''); ?>">
                                                
                                                <div class="col-sm-12">
                                                    <input name="code" type="text" value="<?php echo e(old('code')); ?>" id="code" class="form-control inputbox" required="" placeholder="Code" autofocus>
                                                    <?php if($errors->has('code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="zn_sub_button btn btn-fullcolor th-button-register" value="Continue">
                                                 
                                                </div>
                                                
                                                      
                                          </div>
                                        </form>
                                    </div>
                                  
                                    <!--/ .fancy_register_form -->
                                </div>


                                <div class="col-md-4 col-lg-4">
                                   
                                </div>
                                <!--/ Section right col-sm-10 col-sm-offset-1 col-md-5 col-md-offset-0 -->
                            </div>
                            <!--/ row -->
                        </div>
                        <!--/ .static-content .default-style .static-content--with-login -->
                    </div>
                    <!--/ Container (.sc__container) with safe padding custom top 230px -->
                </div>
                <!--/ .static-content__inner -->
            </div>
            <!--/ .static-content__wrapper -->

            <!-- Bottom mask style 3 -->
            <div class="kl-bottommask kl-bottommask--mask3">
                <svg width="5000px" height="57px" class="svgmask " viewBox="0 0 5000 57" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <defs>
                        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-mask3">
                            <feOffset dx="0" dy="3" in="SourceAlpha" result="shadowOffsetInner1"></feOffset>
                            <feGaussianBlur stdDeviation="2" in="shadowOffsetInner1" result="shadowBlurInner1"></feGaussianBlur>
                            <feComposite in="shadowBlurInner1" in2="SourceAlpha" operator="arithmetic" k2="-1" k3="1" result="shadowInnerInner1"></feComposite>
                            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.4 0" in="shadowInnerInner1" type="matrix" result="shadowMatrixInner1"></feColorMatrix>
                            <feMerge>
                                <feMergeNode in="SourceGraphic"></feMergeNode>
                                <feMergeNode in="shadowMatrixInner1"></feMergeNode>
                            </feMerge>
                        </filter>
                    </defs>
                    <path d="M9.09383679e-13,57.0005249 L9.09383679e-13,34.0075249 L2418,34.0075249 L2434,34.0075249 C2434,34.0075249 2441.89,33.2585249 2448,31.0245249 C2454.11,28.7905249 2479,11.0005249 2479,11.0005249 L2492,2.00052487 C2492,2.00052487 2495.121,-0.0374751261 2500,0.000524873861 C2505.267,-0.0294751261 2508,2.00052487 2508,2.00052487 L2521,11.0005249 C2521,11.0005249 2545.89,28.7905249 2552,31.0245249 C2558.11,33.2585249 2566,34.0075249 2566,34.0075249 L2582,34.0075249 L5000,34.0075249 L5000,57.0005249 L2500,57.0005249 L1148,57.0005249 L9.09383679e-13,57.0005249 Z" class="bmask-bgfill" filter="url(#filter-mask3)" fill="#f5f5f5"></path>
                </svg>
                <i class="glyphicon glyphicon-chevron-down"></i>
            </div>
            <!--/ Bottom mask style 3 -->
        </div>
        <!--/ Slideshow - Static content Text with register + bottom mask style 3 -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>