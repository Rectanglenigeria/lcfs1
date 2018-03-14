<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Give smile / Achieved
       
      </h1>
      
    </section>

    <section class="content">
      <!--refereer link-->
          
        <!--refereer link-->
     <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>

        

       <!-- <div class="callout callout-info">
            
                <center><a href="givesmiles.php"><button type="button" class="btn bg-olive btn-flat margin">Give Smiles</button></a>
              
                <a href="receivesmiles.php"><button type="button" class="btn bg-red btn-flat margin">Receive Smiles</button></a></center>
              
        </div>-->

    <!-- Main content -->
<section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->



        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Achieved Smile(s)</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              
              <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>Invested capital</th>
                  <th>R O I</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

              <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achieved): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e(number_format($achieved->amount,2)); ?></td>
                  <td>
                  <?php echo e(number_format($achieved->growth,2)); ?>

                  </td>
                  <td><?php echo e(number_format(($achieved->amount + $achieved->growth),2)); ?></td>
                  <td><?php echo e($achieved->created_at); ?></td>
                  <td>

                      
                      <?php 
                      $sumAllMatchesAmount=0;
                      $paymentStatusArray=[];
                      $count=0;
                      foreach($achieved->confirmation as $confirmation){
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

                      if($achieved->amount == $sumAllMatchesAmount && $paidAll ==true){
                        $status='Available';
                        $label='label-success';
                      }else{
                        $status="Pending";
                        $label='label-danger';
                      }
                         
                     ?>

                     <?php if(!isset($achieved->rsmile->id)): ?>
                    <label class="label label-md <?php echo e($label); ?>"><?php echo e($status); ?></label>
                    <?php else: ?>
                    <label class="label label-md label-default">Requested</label>
                    <?php endif; ?>
                  </td>
                  <td>
                  <?php if(!isset($achieved->rsmile->id)): ?>
                  <?php if($status=="Available"): ?>
                    <form action="<?php echo e(URL::to('/rsmile/create')); ?>" method="POST">
                                 <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="smileId" value="<?php echo e($achieved->id); ?>"> 
                      <input class="btn btn-primary btn-md" type="submit" name="submit" value="Reap">
                    </form>
                  <?php endif; ?>
                  <?php endif; ?>
                  </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                
               
                </tbody>
                <tfoot>
                <tr>
                  <th>Invested capital</th>
                  <th>R O I</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
            <center style="margin:-15px;">
               <?php echo e($achievedSmiles->links()); ?>

            </center>

            </div>

          </div>
          <!-- /.box -->

            </div>
          </div>
        </section>
        <!-- right col -->





                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>