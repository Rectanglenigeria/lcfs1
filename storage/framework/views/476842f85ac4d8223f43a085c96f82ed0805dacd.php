<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Smile Details
      </h1>
     
    </section>

    <section class="content">
    <!--refereer link-->
         
        <!--refereer link-->
        <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
          <!-- Left col -->
        <div class="col-lg-2"></div>
        <section class="col-lg-6 connectedSortable">
        <a style="float: right;" href="<?php echo e(URL::to('/home')); ?>" class="btn btn-success">Back</a>

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Smile details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-book margin-r-5"></i>Amount</strong>

              <p class="text-muted">
               <?php echo e($smile->amount); ?>

              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Receiver's Name</strong>

              <p class="text-muted">
               <?php echo e($smile->user->name); ?>

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Phone</strong>

              <p class="text-muted"><?php echo e($smile->user->phone); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Account Name</strong>

              <p class="text-muted"><?php echo e($smile->user->account_name); ?></p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Account Number</strong>

              <p class="text-muted"><?php echo e($smile->user->account_no); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Bank</strong>

              <p class="text-muted"><?php echo e(ucwords($smile->user->bank)); ?>&nbsp; Bank</p>

            
              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

                <?php if($smile->left_amount == 0): ?>
                  <label class="label label-default lable-lg">Fully matched</label>
                  <?php elseif($smile->left_amount > 0 && $smile->left_amount < $smile->amount): ?>
                  <label class="label label-default lable-lg">Partially matched</label>
                  <?php elseif($smile->left_amount == $smile->amount ): ?>
                  <label class="label label-default lable-lg">Not matched</label>
                  <?php endif; ?>

            
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>
              <?php if($smile->left_amount > 0): ?>
              <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('admin/matches/select_gs_users/'.$smile->id)); ?>">Match</a>
              <?php endif; ?>
              </p>
            </div>
            <!-- /.box-body -->
          </div>
         
        </section>

        <div class="col-lg-2"></div>




  
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
<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>