<?php $__env->startSection('content'); ?>

   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;User | View</small>
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
        <div class="col-lg-2"></div>
        <section class="col-lg-6 connectedSortable">
        <a style="float: right;" href="<?php echo e(URL::to('/admin/user/list')); ?>" class="btn btn-success">Back</a>

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">


            <form name="login_form" method="POST" class="th-register-form register_form_static form-horizontal" role="form" action="<?php echo e(URL::to('/admin/user/update')); ?>">
                                                 <?php echo e(csrf_field()); ?>



                                      
                                    <input type="hidden" name="id" value="<?php echo e($user->id); ?>">


                                            <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-2 control-label" for="user_login">Name</label>
                                                <div class="col-sm-10">
                                                    <input name="name" type="text" value="<?php echo e($user->name); ?>" id="name" class="form-control inputbox" required="" placeholder="">
                                                    <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>


                                            <hr>

                                            <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-2 control-label" for="user_login">Phone</label>
                                                <div class="col-sm-10">
                                                    <input name="phone" type="number" value="<?php echo e($user->phone); ?>" id="phone" class="form-control inputbox" required="" placeholder="">
                                                    <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                              <hr>

                                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-2 control-label" for="user_login">Email</label>
                                                <div class="col-sm-10">
                                                    <input name="email" type="email" value="<?php echo e($user->email); ?>" id="email" class="form-control inputbox" required="" placeholder="">
                                                    <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>



                                            <br>


                                            <div class="form-group<?php echo e($errors->has('account_no') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-2 control-label" for="user_login">Account No</label>
                                                <div class="col-sm-10">
                                                    <input name="account_no" type="number" value="<?php echo e($user->account_no); ?>" id="account_no" class="form-control inputbox" required="" placeholder="">
                                                    <?php if($errors->has('account_no')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('account_no')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="form-group<?php echo e($errors->has('account_name') ? ' has-error' : ''); ?>">
                                                <label class="col-sm-2 control-label" for="user_login">Account Name</label>
                                                <div class="col-sm-10">
                                                    <input name="account_name" type="text" value="<?php echo e($user->account_name); ?>" id="account_name" class="form-control inputbox" required="" placeholder="">
                                                    <?php if($errors->has('account_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('account_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                                </div>
                                            </div>

<hr>

                                            <div class="form-group<?php echo e($errors->has('bank') ? ' has-error' : ''); ?>">
                    <label for="inputSkills" class="col-sm-2 control-label">Bank</label>

                    <div class="col-sm-10">

                      <a href="btn btn-default" class="h4">
                        <?php if($user->bank != null): ?>
                          <?php echo e(ucwords($user->bank)); ?> bank <br><br>
                        <?php else: ?>
                          <?php echo e('Not set'); ?>

                        <?php endif; ?>
                      </a>

                      <span>&nbsp; Bank</span>

                      <select class="form-control" name="bank">
              <option selected="selected" disabled="disabled">Select bank</option>
            <option value="first">First Bank</option>
<option value="access">Access Bank</option>
<option value="citibank">Citibank</option>
<option value="diamond">Diamond Bank</option>
<option value="ecobank">Ecobank</option>
<option value="fidelity">Fidelity Bank</option>
<option value="fcmb">First City Monument Bank (FCMB)</option>
<option value="fsdh merchant">FSDH Merchant Bank</option>
<option value="gtb">Guarantee Trust Bank (GTB)</option>
<option value="heritage">Heritage Bank</option>
<option value="Keystone">Keystone Bank</option>
<option value="rand merchant">Rand Merchant Bank</option>
<option value="skye">Skye Bank</option>
<option value="stanbic ibtc">Stanbic IBTC Bank</option>
<option value="standard">Standard Chartered Bank</option>
<option value="sterling">Sterling Bank</option>
<option value="sun trust">Suntrust Bank</option>
<option value="union">Union Bank</option>
<option value="uba">United Bank for Africa (UBA)</option>
<option value="unity">Unity Bank</option>
<option value="wema">Wema Bank</option>
<option value="zenith">Zenith Bank</option>

        </select>

        <?php if($errors->has('bank')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('bank')); ?></strong>
                                    </span>
                                <?php endif; ?>
                      


                    </div>
                  </div>

                                           


                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4" style="margin-bottom:0;">
                                                    <input type="submit" name="submit" class="zn_sub_button btn btn-fullcolor th-button-register" value="Update profile">
                                                    
                                                </div>
                                                
                                                      
                                          </div>



                                        </form>




                   <hr>                     

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Referrer link</strong>

              <p class="text-muted"><?php echo e(($user->referer_link)); ?></p>

              <hr>

               <strong><i class="fa fa-map-marker margin-r-5"></i> SMS verification code</strong>

              <p class="text-muted"><?php echo e(($user->activation_code)); ?></p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Tags</strong>

              <p>

              	<?php if($user->is_pioneer == '1'): ?>
                <span class="label label-primary"><?php echo e('Pioneer'); ?></span>
                <?php else: ?>
                <span class="label label-primary"><?php echo e('Ordinary user'); ?></span>
                <?php endif; ?>

                <?php if($user->is_active == '1'): ?>
                <span class="label label-success"><?php echo e('verified'); ?></span>
                <?php else: ?>
                <span class="label label-success"><?php echo e('not verified '); ?></span>
                <?php endif; ?>

                <?php if($user->is_pioneer == '1'): ?>
                <span class="label label-info"><?php echo e('blocked'); ?></span>
                <?php else: ?>
                <span class="label label-info"><?php echo e('active'); ?></span>
                <?php endif; ?>

                <!--<span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>-->
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>

              <?php if($user->is_pioneer == '0' || $user->is_pioneer == null): ?>
              <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/make_pioneer/'.$user->id)); ?>">Make pioneer</a>
               <?php else: ?>
               <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_pioneer/'.$user->id)); ?>">Unmake pioneer</a>
              <?php endif; ?>


               <?php if($user->is_teamlead == '0' || $user->is_teamlead == null): ?>
              <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/make_teamlead/'.$user->id)); ?>">Make Tealead</a>
               <?php else: ?>
               <a class="btn btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_teamlead/'.$user->id)); ?>">Unmake Teamlead</a>
              <?php endif; ?>



              <?php if($user->is_block == '0' || $user->is_block == null): ?>
              <a class="btn btn-info" href="<?php echo e(URL::to('/admin/user/block/'.$user->id)); ?>">Block</a>
               <?php else: ?>
               <a class="btn btn-info" href="<?php echo e(URL::to('/admin/user/unblock/'.$user->id)); ?>">Unblock</a>
              <?php endif; ?>


              <a class="btn btn-danger" href="<?php echo e(URL::to('/admin/user/delete/'.$user->id)); ?>">
              delete</a>

              </p>
            </div>
            <!-- /.box-body -->
          </div>
         
        </section>

        <div class="col-lg-2"></div>







        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->





		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>