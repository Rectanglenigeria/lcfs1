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

              <strong><i class="fa fa-book margin-r-5"></i>Amount (Naira)</strong>

              <p class="text-muted">
               <?php echo e(number_format($smile->amount,2)); ?>

              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Giver's Name</strong>

              <p class="text-muted">
               <?php echo e($smile->user->name); ?>

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Phone</strong>

              <p class="text-muted"><?php echo e($smile->user->phone); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Account Name</strong>

              <p class="text-muted"><?php echo e($smile->user->account_name); ?></p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Account Number</strong>

              <p class="text-muted"><?php echo e($smile->user->account_no); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Bank</strong>

              <p class="text-muted"><?php echo e(ucwords($smile->user->bank)); ?>&nbsp; Bank</p>


              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

              <?php 
                      $sumAllMatchesAmount=0;
                      $paymentStatusArray=[];
                      $count=0;
                      foreach($smile->confirmation as $confirmation){
                        $sumAllMatchesAmount+=$confirmation->amount; 
                        $paymentStatusArray[$count]=$confirmation->payment_status;
                        $count++;
                      }

                      if(in_array(0, $paymentStatusArray) || in_array(1, $paymentStatusArray) || in_array(2, $paymentStatusArray)){
                        $paidAll=false;
                      }else{
                        //all are 3s
                        $paidAll=true;
                      }

                      if($smile->amount == $sumAllMatchesAmount && $paidAll ==true){
                        $status='Available';
                        $label='label-success';
                      }else{
                        $status="Pending";
                        $label='label-danger';
                      }
                         
                     ?>


               
                 <?php if(!isset($smile->rsmile->id)): ?>
                    <label class="label label-md <?php echo e($label); ?>"><?php echo e($status); ?></label>
                    <?php else: ?>
                    <label class="label label-md label-default">Requested</label>
                    <?php endif; ?>

            
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              
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