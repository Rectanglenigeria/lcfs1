
<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo ucwords('Laughter History');?>

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
              <li class="pull-left header"><i class="fa fa-inbox"></i> Achieved Laughter(s)</li>
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
                  <th>SL Date</th>
                  <th>RL Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
   <?php $hasConfirmedInsurance=44;
      $timeEligible=3;?>
              <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $achieved): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php


                //retrieving status of 20%
                $matches=$achieved->gs_match;
                foreach ($matches as $key => $match) {
                  //echo $match->payment_type; echo $match->amount;
                  if($match->gsmile_id==$achieved->id && $match->payment_type==0){
                    $payment_status=$match->payment_status;
                    //echo $match->payment_type;
                    if($payment_status==3){
                      $hasConfirmedInsurance=1; //1 for true and 0 for false
                      $updatedAtInSec=strtotime($match->confirmation->updated_at);
                      $rsIntervalInSec=(10*24*60*60);
                      $projectedRsDateInSec=$updatedAtInSec+$rsIntervalInSec;
                      $projectedRsDateInTimeStamp=Date('F d Y | h:i', $projectedRsDateInSec);

                     }else{

                      $projectedRsDateInTimeStamp="Uncomfirmed 30% insurance";

                    }
                    break 1;
                  }else{
                    if($match->payment_type==2){

                      if($match->gsmile_id=$achieved->id && $match->payment_status==3){
                       $hasConfirmedInsurance=1;
                        $updatedAtInSec=strtotime($match->confirmation->updated_at);
                        $rsIntervalInSec=(10*24*60*60);
                        $projectedRsDateInSec=$updatedAtInSec+$rsIntervalInSec;
                      $projectedRsDateInTimeStamp=Date('F d Y | h:i', $projectedRsDateInSec);

                      }else{
                        $projectedRsDateInTimeStamp="Uncomfirmed 100% insurance";
                      }


                    }else{
                      //definately payment_type=1
                       $projectedRsDateInTimeStamp="Uncomfirmed 30% insurance";
                    }

                    continue;
                  }


                }

              ?>


              <?php
                  if(Auth::user()->id == 37 || Auth::user()->id == 40){
                    continue;
                  }
              ?>



<?php
  if($hasConfirmedInsurance==1){
    $updatedAtInSec=$updatedAtInSec;  //time in sec for 20%
    $nowTimeInsec=time();
    if(($nowTimeInsec-($updatedAtInSec+(10*24*60*60)))>=0){
      $timeEligible=1;

    }else{
      $timeEligible=0;
    }
  }
?>

                  <?php
                        /*$confirmations=$achieved->confirmation;

                        if(empty($confirmations) || !isset($confirmations)){
                          $hasPaidInsurance=false;
                        }else{
                          $hasPaidInsurance=true;
                        }

                    //echo json_encode($confirmations);
                    if($hasPaidInsurance == true){
                     foreach ($confirmations as $key => $confirmation) {


                       if(($confirmation->payment_type == 2 || $confirmation->payment_type == 1) && $confirmation->payment_status == 3){
                        $confirmationTime=$confirmation->updated_at;
                       }
                     }


if(isset($confirmationTime)){
                     $confirmationTimeInSec=strtotime($confirmationTime);
                     $nowTime=time();
                     $duration=15 * 24 * 60 * 60;
                     $timeInterval=$nowTime-$confirmationTimeInSec;
                     $rsDateInSec=$confirmationTimeInSec+$duration;
}
                   } */

                  ?>











                <tr class="<?php if(isset($achieved->rsmile->left_amount) && $achieved->rsmile->left_amount == 0){ echo 'bg-green';}?>">
                  <td><?php echo e(number_format($achieved->amount,2)); ?></td>
                  <td>
                  <?php echo e(number_format($achieved->growth,2)); ?>

                  </td>
                  <td><?php echo e(number_format(($achieved->amount + $achieved->growth),2)); ?></td>
                  <td><?php echo e($achieved->created_at); ?></td>










                  <td>

                  <?php if($hasConfirmedInsurance==1): ?>
                     <label class="label label-sm label-success">
                       <?php echo e($projectedRsDateInTimeStamp); ?>

                     </label>
                  <?php else: ?>
                      <label class="label label-sm label-danger">
                       <?php echo e("Uncomfirmed 30% insurance"); ?>

                     </label>
                  <?php endif; ?>



                  </td>







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

                      if($achieved->amount == $sumAllMatchesAmount && $paidAll ==true && $hasConfirmedInsurance==1 && $timeEligible==1){
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


                  <?php if($status=="Available"): ?>

                    <?php if($achieved->reap_status == 1): ?>
                    <!--<label class="label label-sm label-default">Received</label>-->
                    <?php else: ?>
                    <form action="<?php echo e(URL::to('/rsmile/create')); ?>" method="POST">
                                 <?php echo e(csrf_field()); ?>

                      <input type="hidden" name="smileId" value="<?php echo e($achieved->id); ?>">
                      <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Receive">
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
                  <th>RL Date</th>
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