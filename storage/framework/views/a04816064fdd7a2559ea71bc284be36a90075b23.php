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
                                <div class="col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0">

                                    <div style="margin-top: -70px;">

                                    <div class="logo-container hasInfoCard logosize--yes hidden-lg hidden-md">
             
            

            
    </div>
                                    <!-- Title -->
                                    <h2 style="text-align: center; color: red;" class="static-content__title hidden-lg hidden-md"><b>SMILESTEADILY</b></h2>
                                    <h2 class="static-content__title hidden-xs hidden-sm">SMILESTEADILY</h2>

                                    <!-- Sub-title -->
                                    <h3 class="static-content__subtitle"><span class="fw-thin">This is a unique platform where you Give Smile (GS) as help to fellow member of the community and have 100% returns as Received Smile (RS).</h3>
                                    </div>
                                </div>
                                <!--/ Section left col-sm-10 col-sm-offset-1 col-md-7 col-md-offset-0 -->

                                <!-- Section right -->
                                <div class="col-sm-10 col-sm-offset-1 col-md-5 col-md-offset-0">
                                    <!-- Fancy register form -->
                                    <div class="fancy_register_form">
                                        <!-- Title centered -->
                                        <h4 style="text-align:center">Create <strong>your account</strong> now</h4>

                                        <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>
                                        <form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="<?php echo e(route('register')); ?>">
                                                 <?php echo e(csrf_field()); ?>


                                            <input type="hidden" name="referer_phone" value="<?php echo e($referer_phone); ?>">
                                            <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-4 control-label" for="user_login">Phone number</label>
                                                <div class="col-sm-8">
                                                    <input name="phone" type="number" value="<?php echo e(old('phone')); ?>" id="phone" class="form-control inputbox" required="" placeholder="08078786756">
                                                    <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-4 control-label" for="user_email">Email</label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control inputbox required" placeholder="johndoe@gmail.com" value="<?php echo e(old('email')); ?>">
                                                    <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-4 control-label" for="user_password">Your password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" name="password" id="password" class="form-control inputbox" required="" placeholder="Your password">
                                                    <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label" for="user_password2">Verify password</label>
                                                <div class="col-sm-8">
                                                    <input id="password-confirm" type="password" name="password_confirmation" class="form-control inputbox" required="" placeholder="Verify password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="zn_sub_button btn btn-fullcolor th-button-register" value="Sign Up">
                                                    <a class="h4" href="<?php echo e(route('login')); ?>">&nbsp;or login</a>
                                                </div>
                                                
                                                      
                                          </div>
                                        </form>
                                    </div>
                                    <!--/ .fancy_register_form -->
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


        <!-- Action Box - Style 3 section with custom top padding and white background color -->
        <section class="hg_section bg-white ptop-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="action_box style3" data-arrowpos="center" style="margin-top:-25px;">
                            <div class="action_box_inner">
                                <div class="action_box_content">
                                    <div class="ac-content-text">
                                        <!-- Title -->
                                        <h4 class="text"><span class="fw-thin">SMILESTEADILY  <span class="fw-semibold">To create a sustainable,  </span> rewarding & unequalled donating platform</span></h4>
                                        <!--/ Title -->

                                        <!-- Sub-Title -->
                                        <h5 class="ac-subtitle">that will bring financial success to all and sundry</h5>
                                        <!--/ Sub-Title -->
                                    </div>

                                    <!-- Call to Action buttons -->
                                    <div class="ac-buttons">
                                        <a class="btn btn-lined ac-btn" href="#" target="_blank">SIGN UP NOW</a>
                                    </div>
                                    <!--/ Call to Action buttons -->
                                </div>
                                <!--/ action_box_content -->
                            </div>
                            <!--/ action_box_inner -->
                        </div>
                        <!--/ action_box style3 -->
                    </div>
                    <!--/ col-md-12 col-sm-12 -->
                </div>
                <!--/ row -->
            </div>
            <!--/ container -->
        </section>
        <!--/ Action Box - Style 3 section with custom top padding and white background color -->

        <!-- Title - Style 1 section with custom top padding -->
        <section class="hg_section bg-white ptop-65">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- Title element -->
                        <div class="kl-title-block clearfix text-center tbk-symbol-- tbk-icon-pos--after-title">
                            <!-- Title with montserrat font, custom font size and line height, bold style and light gray color -->
                            <h3 class="tbk__title montserrat fs-44 lh-44 fw-bold light-gray3">ABOUT US | @ Smilesteadily?</h3>
                            <!--/ Title with montserrat font, custom font size and line height, bold style and light gray color -->

                          
                          
                          
                          
                            <!-- Sub-Title with custom font size an very thin style -->
                            <h4 class="tbk__subtitle fs-18 fw-vthin">Well, lots of reasons, but most importantly because..</h4>
                            <!--/ Sub-Title with custom font size an very thin style -->
                        </div>
                        <!--/ Title element -->
                    </div>
                    <!--/ col-md-12 col-sm-12 -->
                </div>
                <!--/ row -->
            </div>
            <!--/ container -->
                                <!-- Title style 2 -->
                        <div class="kl-title-block clearfix text-center pb-20" style="margin:0px 20px 0px 20px:">
                            
                            <h4 class="kl-iconbox__desc fs-14 gray">
                          SMILESTEADILY is a peer-to-peer donating platform that is created out of unbridled passion to see a society where every man will enjoy financial success regardless of age, sex or social class. This is a platform where one gets double of whatever sum donated to a fellow participant in the next 15 days after payment confirmation. This translates to a whopping 100% returns on your donation. It is our will and plan to create a platform that will be sustainable, rewarding and where participants can donate confidently with hope of getting their returns without any form of hassles. We are not driven by greed but selflessness. Our footprints will be engraved on the sand of time , as we are poised to put lasting smile on the faces of our participants across board.
                            </h4>
                        </div>
                        <!--/ Title style 2 -->
          
          <div class="">
          <div class="ac-buttons">
            <center><a class="btn  btn-danger  ac-btn" href="<?php echo e(URL::to('/about')); ?>" target="_blank">LEARN MORE</a></center>
         </div>
          </div>
          
        </section>
        <!--/ Title - Style 1 section with custom top padding -->

      
      
      


        <!-- Services section -->

        <section class="hg_section bg-white pt-50 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 mb-40">
                        <!-- Kallyas icon -->

                        <!--/ Kallyas icon -->

                        <!-- Title style 2 -->
                        <div class="kl-title-block clearfix text-center pb-20">
                            <h3 class="tbk__title montserrat fs-26 fw-normal dark-gray mb-20"> HOW IT WORKS<a name="hiw">.</a></h3>
                            <h4 class="tbk__subtitle fw-thin">
                          
                            smilesteadily.com is a noble P2P Donation Platform that delivers 100% returns in 15 days for its participants. Our special terms are GS &amp; RS
                            <br><br>
                            GS <strong style="color:red;">GIVE SMILE</strong> | RS <strong style="color:red;">RECEIVE SMILE</strong>
                          
                            </h4>
                            <br>
                            <br>
                            <p>It employs an INSURANCE DOWN PAYMENT of 10% &amp; RECOMMITMENT FEE of 20% of the total GIVE SMILE (GS) value in order to ensure commitment, sustainability and longevity which are vital parts of our core values. What this implies is that, every participant will have 10% of his total GIVE SMILE (GS) matched for pay-out almost immediately after registration while 20% of his total RECEIVE SMILE (RS) cash-out will be retained in the system, but to be released by next RS date. Any matured RS to be cashed out is dependent upon confirmation of 10% DOWN PAYMENT of a new GS.</p>
                        </div>
                        <!--/ Title style 2 -->

                        <div class="hg_separator"></div>
                    </div>
                    <!--/ col-md-10 col-md-offset-1 -->

                    <div class="col-md-6">
                        <div class="text-right mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-right pull-none-xs" src="<?php echo e(asset('public/pages/images/set-03-02.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Sign Up</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs">Log on to: smilesteadily.com and sign up with your correct details by imputing valid Email Address and Mobile Number. A unique VERIFICATION CODE will be sent to your given mobile number to complete your registration. Always ensure that DND is inactive on such mobile number to be used for the registration. Then, proceed to enter your banking details in the appropriate column and save. This step makes you an eligible participant on the platform.</p>
                        </div>
                        <!--/ text-right mr-20 mr-xs-0 mb-80 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->

                    <div class="col-md-6">
                        <div class="mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-left pull-none-xs" src="<?php echo e(asset('public/pages/images/set-03-03.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Give Smiles</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs">Click on GIVE SMILE (GS) and enter the desired amount of smile that you wish to give to a fellow participant. Click on save and the GIVE SMILE (GS) Amount is recorded by the system. Note that the value should be imputed in figures without any sign. For example, a sum of Fifty Thousand Naira should be imputed as: 50000. Every participant has 48 HOURS payment time with a one-time extension of 24 hours. Always endeavour to pay earlier to avoid late confirmation.</p>
                        </div>
                        <!--/ ml-20 mb-80 ml-xs-0 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->

                    <div class="col-md-6">
                        <div class="text-right mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-right pull-none-xs" src="<?php echo e(asset('public/pages/images/set-03-04.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Connected</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs">Immediately, the details of the person to receive 10% of your SMILE will reflect on the dashboard. Click on the name to get the person's account details.</p>
                        </div>
                        <!--/ text-right mr-20 mr-xs-0 mb-80 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->

                    <div class="col-md-6">
                        <div class="mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-left pull-none-xs p-22" src="<?php echo e(asset('public/pages/images/set-03-01.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Take Action</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs">Give your 10% smile to the receiver by making the payment and then proceed to upload your ORIGINAL PROOF OF PAYMENT (POP) only for confirmation. Uploading of any other image aside the original POP should be totally avoided.</p>
                        </div>
                        <!--/ text-right mr-20 mr-xs-0 mb-80 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->
                  
                  <div class="col-md-6">
                        <div class="text-right mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-right pull-none-xs" src="<?php echo e(asset('public/pages/images/ib-ico-5.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Step to ROI</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs">After your 10% Smile given has been confirmed, your 15 days starts counting and your Receive Smile (RS) Date will be displayed on your dashboard. Then, continually check your dashboard/account at least twice daily to know whenever your remaining 90% smile is matched to avoid a default. Any default attract total BAN of the defaulter's account from the system.</p>
                        </div>
                        <!--/ text-right mr-20 mr-xs-0 mb-80 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->

                  <div class="col-md-6">
                        <div class="mb-80 mb-xs-40 clearfix">
                            <!-- Icon wrapper -->
                            <div class="kl-iconbox__icon-wrapper ml-xs-0 text-center-xs">
                                <img class="kl-iconbox__icon agency-icons pull-left pull-none-xs p-22" src="<?php echo e(asset('public/pages/images/ib-ico-12.svg')); ?>" alt="Iconic Awarded Design">
                            </div>
                            <!--/ Icon wrapper -->

                            <!-- Title -->
                            <h3 class="fs-l fw-bold text-center-xs">Receive Smiles</h3>

                            <!-- Description -->
                            <p class="text-gray text-center-xs"> Then, wait patiently to Receive your own smile (RS) on your due RS date. Fellow participant(s) will be matched to give you SMILE as generated by the system on your due date after the 10% of your new GS has been confirmed.</p>
                        </div>
                        <!--/ text-right mr-20 mr-xs-0 mb-80 mb-xs-40 clearfix -->
                    </div>
                    <!--/ col-md-6 -->
                  
                  
                  
      
                  
                  
                  
                  

                    
                </div>
                <!--/ row -->
            </div>
            <!--/ container -->
        </section>
        <!--es section -->
      
      
        
        <!-- Media Container - Border Animate Style 2 section with background white color -->
        <section class="hg_section bg-white p-0">
            <div class="full_width">
                <div class="row gutter-lg">
                    <div class="col-md-5 col-sm-12">
                        <!-- Media container style 2 element - with custom height(.h-615) -->
                        <div class="media-container style2 h-615">
                            <!-- Background -->
                            <div class="kl-bg-source">
                                <!-- Background image -->
                                <div class="kl-bg-source__bgimage" style="background-image:url(images/t5.jpg); background-repeat:no-repeat; background-attachment:scroll; background-position-x:center; background-position-y:top; background-size:cover">
                                </div>
                                <!--/ Background image -->

                                <!-- Gradient overlay -->
                                <div class="kl-bg-source__overlay" style="background:rgba(137,173,178,0.3); background: -moz-linear-gradient(left, rgba(137,173,178,0.3) 0%, rgba(53,53,53,0.65) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(137,173,178,0.3)), color-stop(100%,rgba(53,53,53,0.65))); background: -webkit-linear-gradient(left, rgba(137,173,178,0.3) 0%,rgba(53,53,53,0.65) 100%); background: -o-linear-gradient(left, rgba(137,173,178,0.3) 0%,rgba(53,53,53,0.65) 100%); background: -ms-linear-gradient(left, rgba(137,173,178,0.3) 0%,rgba(53,53,53,0.65) 100%); background: linear-gradient(to right, rgba(137,173,178,0.3) 0%,rgba(53,53,53,0.65) 100%); ">
                                </div>
                                <!--/ Gradient overlay -->
                            </div>
                            <!--/ Background -->

                            <!-- media container link button -->
                            <a class="media-container__link media-container__link--btn media-container__link--style-borderanim2 " href="https://www.youtube.com/watch?v=cVt-3vbENOQ" data-lightbox="iframe">
                                <!-- SVG border -->
                                <div class="borderanim2-svg">
                                    <!-- svg -->
                                    <svg height="70" width="400" xmlns="http://www.w3.org/2000/svg">
                                        <rect class="borderanim2-svg__shape" height="70" width="400"></rect>
                                    </svg>
                                    <!--/ svg -->

                                    <!-- Title text -->
                                    <span class="media-container__text">Smilesteadily </span>
                                    <!--/ Title text -->
                                </div>
                                <!--/ SVG border -->
                            </a>
                            <!--/ media container link button -->
                        </div>
                        <!--/ media-container style2 h-615 -->
                    </div>
                    <!--/ col-md-5 col-sm-12 -->

                  <div class="col-md-4 col-sm-4">
                        <!-- Text box element -->
                        <div class="text_box">
                          
                     
                          <h5 class="fs-l fw-bold text-center small">SUSTAINABILITY </h5>
                            <p>This platform is created to stand a test of time and proper plan and systems have been put in place to ensure its sustainability. Your donation can't be safer anywhere than in SMILESTEADILY.</p>
                          
                          <h3 class="fs-l fw-bold text-center small">CONSISTENCY </h3>
                            <p> We will always ensure that our participants smile always by getting returns on their donations. Their payments will be consistent, as we are selfless, effective and efficient in our service delivery and platform management.</p>
                        </div>
                        <!--/ Text box element -->  
                    </div>
                    <!--/ col-md-4 col-sm-4 -->

                    <div class="col-md-4 col-sm-4">
                        <!-- Text box element -->
                        <div class="text_box">
                          
                          <h3 class="fs-l fw-bold text-center small">SATISFACTION</h3>
                            <p> We respect our participants and as a result of this, their utmost satisfaction is our priority. We shall always improve in all necessary areas to make YOU smile steadily</p>
                          
                          <h3 class="fs-l fw-bold text-center small">FIDELITY </h3>
                            <p>  We appreciate the trust our participants have on this platform, and as a result of this we will constantly deliver the without blemish. We shall always keep our words.</p>
                        </div>
                        <!--/ Text box element -->
                    </div>
                    <!--/ col-md-4 col-sm-4 -->
                </div>
                <!--/ row gutter-lg -->
            </div>
            <!--/ full_width -->
        </section>
        <!--/ Media Container - Border Animate Style 2 section with background white color -->

        
        <!-- Step boxes style 2 (go boxes) element section with white background and custom bottom padding -->
        <section class="hg_section bg-white pbottom-80">
            <div class="container">
                <div class="row gutter-md">
                    <div class="col-sm-4">
                        <!-- Step box element #2 (First Go box) -->
                        <div class="gobox gobox-first ">
                            <!-- Content -->
                            <div class="gobox-content">
                                <!-- Title -->
                                <h4>sign up </h4>
                                <!--/ Title -->

                                <!-- Link -->
                                <a class="step_link" href="#" target="_blank"></a>
                                <!--/ Link -->

                                <!-- Description -->
                                <p>
                                    Sign up with your correctly by imputing valid Email and Mobile Number
                                </p>
                                <!--/ Description -->
                            </div>
                            <!--/ Content -->
                        </div>
                        <!--/ Step box element #2 (First Go box) -->
                    </div>
                    <!--/ col-sm-4 -->

                    <div class="col-sm-4">
                        <!-- Step box #2 (Second Go box) -->
                        <div class="gobox ">
                            <!-- Content -->
                            <div class="gobox-content">
                                <!-- Title -->
                                <h4>give smiles</h4>
                                <!--/ Title -->

                                <!-- Link -->
                                <a class="step_link" href="#" target="_blank"></a>
                                <!--/ Link -->

                                <!-- Description -->
                                <p>
                                    GIVE SMILE (GS) and enter a desired amount of smile that you wish to give to a fellow participant.
                                </p>
                                <!--/ Description -->
                            </div>
                            <!--/ Content -->
                        </div>
                        <!--/ Step box #2 (Second Go box) -->
                    </div>
                    <!--/ col-sm-4 -->

                    <div class="col-sm-4">
                        <!-- Step box #2 (Last Go box) -->
                        <div class="gobox ok gobox-last">
                            <!-- Icon = .glyphicon-ok-circle -->
                            <span class="glyphicon glyphicon-ok-circle"></span>
                            <!--/ Icon = .glyphicon-ok-circle -->

                            <!-- Content -->
                            <div class="gobox-content">
                                <!-- Title -->
                                <h4>receive smiles</h4>
                                <!--/ Title -->

                                <!-- Link -->
                                <a class="step_link" href="#" target="_blank"></a>
                                <!--/ Link -->

                                <!-- Description -->
                                <p>
                                    Then, wait patiently to Receive your own smile (RS) on your due RS date. 
                                </p>
                                <!--/ Description -->
                            </div>
                            <!--/ Content -->
                        </div>
                        <!--/ Step box #2 (Last Go box) -->
                    </div>
                    <!--/ col-sm-4 -->
                </div>
                <!--/ row gutter-md -->
            </div>
            <!--/ container -->
        </section>
        <!--/ Step boxes style 2 (go boxes) element section with white background and custom bottom padding -->
      
        <!-- Latest Posts - Accordion Style section -->
       
        <!--/ Latest Posts - Accordion Style section -->

        <!-- Partners & Testimonials section with custom paddings -->
        <section class="hg_section hg_section--relative ptop-80 pbottom-80">
            <!-- Background -->
            <div class="kl-bg-source">
                <!-- Gradient overlay -->
                <div class="kl-bg-source__overlay" style="background:rgba(205,33,34,1); background: -moz-linear-gradient(left, rgba(205,33,34,1) 0%, rgba(245,72,76,1) 100%); background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(205,33,34,1)), color-stop(100%,rgba(245,72,76,1))); background: -webkit-linear-gradient(left, rgba(205,33,34,1) 0%,rgba(245,72,76,1) 100%); background: -o-linear-gradient(left, rgba(205,33,34,1) 0%,rgba(245,72,76,1) 100%); background: -ms-linear-gradient(left, rgba(205,33,34,1) 0%,rgba(245,72,76,1) 100%); background: linear-gradient(to right, rgba(205,33,34,1) 0%,rgba(245,72,76,1) 100%); ">
                </div>
                <!--/ Gradient overlay -->
            </div>
            <!--/ Background -->

            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <!-- Title element with bottom line style -->
                        <div class="kl-title-block clearfix text-center tbk-symbol--line tbk-icon-pos--after-title">
                            <!-- Title with montserrat font, white color and bold style -->
                            <h3 class="tbk__title white montserrat fw-bold">TESTIMONIAL</h3>
                            <!--/ Title with montserrat font, white color and bold style -->

                            <!-- Title bottom symbol -->
                            <div class="tbk__symbol ">
                                <span></span>
                            </div>
                            <!--/ Title bottom symbol -->
                        </div>
                        <!--/ Title element with bottom line style -->

                        <!-- Testimonials & Partners element - light text style -->
                        <div class="testimonials-partners testimonials-partners--light">
                            <!-- Testimonials  element-->
                            <div class="ts-pt-testimonials clearfix">
                               
                                <!-- Item - size 1 and reversed style -->
<?php $count =0; ?>
    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimony): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(!isset($testimony->user->name)){
        continue;
    }
    ?>

    <?php if($count >= 4) {

        break;
        }?>

                                <div class="ts-pt-testimonials__item ts-pt-testimonials__item--size-1 ts-pt-testimonials__item--reversed" style=" ">
                                    <!-- Testimonial info -->
                                    <div class="ts-pt-testimonials__infos ts-pt-testimonials__infos--">
                                        <!-- User image -->
                                        <div class="ts-pt-testimonials__img" style="background-image:url(<?php echo e(asset('public/auth_pages/dist/img/avatar.png')); ?>);" title="SAMMY BROWNS">
                                        </div>
                                        <!--/ User image -->

                                        <!-- Name -->
                                        <h4 class="ts-pt-testimonials__name"><?php echo e($testimony->user->name); ?></h4>
                                        <!--/ Name -->

                                        <!-- Position -->
                                           <?php echo e(date('F d, Y', strtotime($testimony->updated_at))); ?>

                                        <!--/ Position -->

                                        <!-- Review stars - 5 stars -->
                                      
                                        <!--/ Review stars - 5 stars -->
                                    </div>
                                    <!--/ Testimonial info - .ts-pt-testimonials__infos -->

                                    <!-- Testimonial text -->
                                    <div class="ts-pt-testimonials__text">
                                        <p style="line-height:25px;">“<?php echo e(substr($testimony->message,0,65)); ?></p>
        <p><a href="<?php echo e(URL::to('/testimonial/view/'.$testimony->id)); ?>" class="btn btn-danger btn-sm" role="button">View</a> </p>
                                    </div>
                                    <!--/ Testimonial text -->
                                </div>

            <?php $count ++ ; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                                <!--/ Item - size 1 and reversed style - .ts-pt-testimonials__item -->
                            </div>
                            <!--/ Testimonials element - .ts-pt-testimonials-->

                            <!-- Separator for testimonials-partners elements -->
                            <!--/ Separator for testimonials-partners elements -->

                            <!-- Partners element -->
                            
                            <!--/ Partners element - .ts-pt-partners -->
                        </div>
                        <!--/ Testimonials & Partners element - light text style -->
                    </div>
                    <!--/ col-md-12 col-sm-12 -->
                </div>
                <!--/ row -->
            </div>
            <!--/ container -->
        </section>
        <!--/ Partners & Testimonials section with custom paddings -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>