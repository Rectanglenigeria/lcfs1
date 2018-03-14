
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <section class="content">
   <!--refereer link-->
          <p class="alert alert-success alert-sm alert-dismissable" style="overflow-x: auto;">
          <?php 
          $phone = base64_encode(Auth::user()->phone);
          $refLink="https://www.smilesteadily.net/referrer/".$phone;
           ?>
            Your referrer link is : <?php echo e($refLink); ?>

          </p>
        <!--refereer link-->
        <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>



    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?php echo e(asset('public/auth_pages/dist/img/avatar.png')); ?>" alt="User profile picture">

              <h3 class="profile-username text-center">
              <?php if(Auth::user()->name != null): ?>
              <?php echo e(Auth::user()->name); ?>

              <?php else: ?>
              <?php echo e('Not set'); ?>

              <?php endif; ?>
              </h3>

              <p class="text-muted text-center">
                <?php if(Auth::user()->phone != null): ?>
              <?php echo e(Auth::user()->phone); ?>

              <?php else: ?>
              <?php echo e('Not set'); ?>

              <?php endif; ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Account Name</b> <a class="pull-right">
                    <?php if(Auth::user()->account_name != null): ?>
              <?php echo e(Auth::user()->account_name); ?>

              <?php else: ?>
              <?php echo e('Not set'); ?>

              <?php endif; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Account Number</b> <a class="pull-right">
                    <?php if(Auth::user()->account_no != null): ?>
              <?php echo e(Auth::user()->account_no); ?>

              <?php else: ?>
              <?php echo e('Not set'); ?>

              <?php endif; ?>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Bank</b> <a class="pull-right">
                    <?php if(Auth::user()->bank != null): ?>
              <?php echo e(Auth::user()->bank); ?>

              <?php else: ?>
              <?php echo e('Not set'); ?>

              <?php endif; ?>
                  </a>
                </li>
              </ul>

              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a href="#activity" data-toggle="tab">Edit profile</a></li>
              
            </ul>
            <div class="tab-content">
              

              <div class="" id="activity">
                <form name="profile_form" class="form-horizontal" role="form" method="POST" action="<?php echo e(URL::to('/user_profile')); ?>">

                 <?php echo e(csrf_field()); ?>


                  <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input name="name" type="text" class="form-control" id="inputName" placeholder="Name" value="
                      <?php if(Auth::user()->name != null): ?>
              <?php echo e(Auth::user()->name); ?>

              <?php else: ?>
              <?php echo e(old('name')); ?>

              <?php endif; ?>">
                      <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                    </div>
                  </div>
                  <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                    <label for="inputPhone" class="col-sm-2 control-label">Phone</label>

                    <div class="col-sm-10">
                      <input name="phone" type="<?php if(Auth::user()->phone != null): ?>
              <?php echo e('text'); ?>

              <?php else: ?>
              <?php echo e('number'); ?>

              <?php endif; ?>" class="form-control" id="inputPhone" placeholder="Name" value="
                      <?php if(Auth::user()->phone != null): ?>
              <?php echo e(Auth::user()->phone); ?>

              <?php else: ?>
              <?php echo e(old('phone')); ?>

              <?php endif; ?>">
                      <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                    </div>
                  </div>
                  <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Name" value="
                      <?php if(Auth::user()->email != null): ?>
              <?php echo e(Auth::user()->email); ?>

              <?php else: ?>
              <?php echo e(old('email')); ?>

              <?php endif; ?>">
                      <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                    </div>
                  </div>




                  

                  <div class="user-block">
                    
                        <span class="username">
                          <a href="#">Bank</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Your account details</span>
                  

                  <div class="form-group<?php echo e($errors->has('account_name') ? ' has-error' : ''); ?>">
                    <label for="inputName" class="col-sm-2 control-label">Account Name</label>

                    <div class="col-sm-10">

                      <input type="text" name="account_name" class="form-control" id="inputName" placeholder="Account Name" value="
                      <?php if(Auth::user()->account_name != null): ?>
              <?php echo e(Auth::user()->account_name); ?>

              <?php else: ?>
              <?php echo e(old('account_name')); ?>

              <?php endif; ?>" <?php if(!empty(Auth::user()->account_name)): ?>
              <?php echo e('disabled'); ?>

              <?php endif; ?>
              >
                      <?php if($errors->has('account_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('account_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group<?php echo e($errors->has('account_name') ? ' has-error' : ''); ?>">
                    <label for="inputExperience" class="col-sm-2 control-label">Account Number</label>

                    <div class="col-sm-10">
                      <input type="
                      <?php if(Auth::user()->account_no != null): ?>
              <?php echo e('text'); ?>

              <?php else: ?>
              <?php echo e('number'); ?>

              <?php endif; ?>" name="account_no" class="form-control" id="inputSkills" placeholder="Account Number" value="
                      <?php if(Auth::user()->account_no != null): ?>
              <?php echo e(Auth::user()->account_no); ?>

              <?php else: ?>
              <?php echo e(old('account_no')); ?>

              <?php endif; ?>" 
              <?php if(!empty(Auth::user()->account_no)): ?>
              <?php echo e('disabled'); ?>

              <?php endif; ?>

              >
                      <?php if($errors->has('account_no')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('account_no')); ?></strong>
                                    </span>
                                <?php endif; ?>
                    </div>
                  </div>

                  <div class="form-group<?php echo e($errors->has('bank') ? ' has-error' : ''); ?>">
                    <label for="inputSkills" class="col-sm-2 control-label">Bank</label>

                    <div class="col-sm-10">

                      <a href="btn btn-default" class="h4">
                        <?php if(Auth::user()->bank != null): ?>
                          <?php echo e(ucwords(Auth::user()->bank)); ?> bank <br><br>
                        <?php else: ?>
                          <?php echo e('Not set'); ?>

                        <?php endif; ?>
                      </a>

                      <span>&nbsp; Bank</span>

                      <select class="form-control" name="bank" <?php if(!empty(Auth::user()->account_no)): ?>
              <?php echo e('disabled'); ?>

              <?php endif; ?>>
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
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                            <a href="#">by clicking update, you agree to the terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
          <!-- Map box -->
                        <!-- /. tools -->

                              <!-- ./col -->
            
          <!-- /.box -->

          <!-- Calendar -->
          
               
                <!-- /.col -->
                
                <!-- /.col -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>