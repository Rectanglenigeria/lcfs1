<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADILY
        <small>Welcome User</small>
      </h1>

    </section>




    <section class="content">


      <div class="alert alert-default alert-sm alert-dismissable">
        <span class="h4">Latest News : </span>
        <marquee>
            <?php $count =1;?>
          <?php $__currentLoopData = $newsfeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="">
          <?php echo e(date('F d, Y', strtotime($new->updated_at))); ?></span> &nbsp;|&nbsp;
          <span><b><?php echo e($new->title); ?></b></span>
          &nbsp;
          <a class="label label-primary label-xs" href="<?php echo e(URL::to('/news/view/'.$new->id)); ?>">Read more</a>
          <span>&nbsp;&nbsp;&nbsp;</span>
          <?php
            if($count >5){
              break;
            }

            $count++;
          ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </marquee>



            </div>






    <div class="alert alert-info alert-sm alert-dismissable">
            <span>Notices: </span>
            <ol>
            <li>
               Use your spare money

            </li>

            <li>
               Always upload an original proof of payment
            </li>



            </ol>


          </div>

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

        <div class="callout callout-info">

                <center><a href="<?php echo e(URL::to('/gsmile/create')); ?>"><button type="button" class="btn bg-olive btn-flat margin">Give Smile</button></a>

                <a href="<?php echo e(URL::to('/rsmile/create')); ?>"><button type="button" class="btn bg-red btn-flat margin">Receive Smile</button></a></center>

        </div>

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

              <li class="pull-left header"><i class="fa fa-inbox"></i> Match list</li>
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
                  <th>Giver's Name</th>
                  <th>Receiver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php $count=0?>
<?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(!isset($match->gsmile->user->name) || !isset($match->rsmile_user->name) ){
  continue;
}
?>

                <tr>


                  <td>
                     <?php echo e($match->gsmile->user->name); ?>

                  </td>
                  <td>
                    <?php echo e($match->rsmile_user->name); ?>

                  </td>
                  <td>

                  <?php echo e(number_format($match->amount,2)); ?>


                  </td>
                  <td>
                    <!--<?php echo e($match->created_at); ?> |-->

<?php if($timeLeftArray[$count] <= 0): ?>
                    <?php echo e('----'); ?>

                    <?php elseif($match->payment_status == 3): ?>
                      <?php echo e('0d:0h:0m:0s'); ?>

                     <?php elseif($match->payment_status == 2): ?>
                     <?php echo e('0d:0h:0m:0s'); ?>

                     <?php else: ?>







                  <?php


                    $duration=$timeLeftArray[$count];
                  /*  if($duration <= 0){
                     echo '----';
                   }*/

                    if(intval($match->is_extended)== 1){
                      $allocatedTimeInMs=(48+12)*60*60;
                    }else{
                       $allocatedTimeInMs=(48)*60*60;
                    }

                    $duration1=$allocatedTimeInMs-(time()-strtotime($match->created_at));




$secondsLeft = $duration1;
$days = floor($secondsLeft / (60*60*24));
$hours = floor ( ($secondsLeft - ($days*60*60*24)) / (60*60) );
$mins =  floor(  ($secondsLeft-($days*60*60*24) - ($hours*60*60))/60);
                  ?>

                  <span> <?php
                        echo $days."D : ".$hours."H : ".$mins."M";
                  ?></span>

                  <?php endif; ?>
                  </td>
                  <td>

                  <?php if($match->payment_status == 0): ?>
              <label class="label label-default lable-lg">Processing</label>
               <?php elseif($match->payment_status == 1): ?>
               <label class="label label-default lable-lg">Matched</label>
               <?php elseif($match->payment_status == 2): ?>
                <label class="label label-default lable-lg">Awaiting confirmation</label>
              <?php else: ?>
               <label class="label label-default lable-lg">Confirmed</label>
              <?php endif; ?>
              </td>
              <td>

              <!-- action-->
              <?php if($match->payment_status != 0): ?>

                  <?php if(Auth::user()->id == $match->gsmile->user->id): ?>
               <a class="btn btn-primary btn-sm" href="<?php echo e(URL::to('/matches/view/'.$match->id)); ?>">View</a>
                <?php endif; ?>

                 <?php if(Auth::user()->id == $match->rsmile_user->id): ?>
               <a class="btn btn-primary btn-sm" href="<?php echo e(URL::to('/matches/viewrs/'.$match->id)); ?>">View</a>
                <?php endif; ?>

              <?php endif; ?>

                  </td>



                </tr>
    <?php $count ++;?>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
                <tfoot>
                <tr>
                   <th>Giver's Name</th>
                  <th>Receiver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               <?php echo e($matches->links()); ?>

            </center>

            </div>

          </div>
          <!-- /.box -->



            </div>
          </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Transaction list</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Giver's Name</th>
                  <th>Receiver's Name</th>
                  <th>Amount (Naira)</th>
                </tr>
                </thead>
                <tbody>
      <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <?php
                      if(!isset($transaction->gsmile->user->name)){
                        continue;
                      }

                      if(!isset($transaction->rsmile_user->name)){
                        continue;
                      }
                  ?>

                <tr>
                  <td><?php echo e($transaction->gsmile->user->name); ?></td>
                  <td><?php echo e($transaction->rsmile_user->name); ?></td>
                  <td><?php echo e(number_format($transaction->amount,2)); ?></td>

                </tr>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
                <tfoot>
                <tr>
                  <th>Giver's Name</th>
                  <th>Receiver's Name</th>
                  <th>Amount (Naira)</th>

                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               <?php echo e($transactions->links()); ?>

            </center>

            </div>
          </div>
          <!-- /.box -->


            </div>
          </div>


        <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Referrer list preview</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->

              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Referree's Name</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>




<?php if(!empty($referees)): ?>

<?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!isset($referee->referee_user->name)){
  continue;
}
?>    <tr>
                  <td><?php echo e($referee->referee_user->name); ?></td>
                  <td><?php echo e($referee->created_at); ?>

                  </td>
                </tr>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

  <?php endif; ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Giver's Name</th>
                  <th>Receiver's Name</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               <?php echo e($referees->links()); ?>

            </center>

            </div>

          </div>
          <!-- /.box -->

            </div>
          </div>





        </section>

<section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i>Latest news</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <ul class="timeline">


         <?php $count =1;?>
        <?php $__currentLoopData = $newsfeeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            if($count >1){
              break;
            }
          ?>
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    <?php echo e(date('F d, Y', strtotime($news->updated_at))); ?>

                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(date('h:i',strtotime($news->updated_at))); ?></span>

                <h3 class="timeline-header"><a href="#">Title</a>: <?php echo e($news->title); ?></h3>

                <div class="timeline-body">
                  <?php echo e(substr($news->body, 0, 250)); ?>

                   <?php if(strlen($news->body)==250): ?>
                   <?php echo e('.'); ?>

                   <?php else: ?>
                   <?php echo e('...'); ?>

                   <?php endif; ?>
                </div>
                <div class="timeline-footer">
                  <?php if(strlen($news->body)==250): ?>
                   <?php echo e(null); ?>

                   <?php else: ?>
                  <a class="btn btn-primary btn-xs" href="<?php echo e(URL::to('/news/view/'.$news->id)); ?>">Read more</a>
                  <?php endif; ?>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php $count++;?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


            </div>
          </div>


        <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Latest paid participants</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->

              <div class="box">

<?php if(!empty($latestPaid)): ?>
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>

                  <th>Name</th>


                  <th>Phone Number</th>
                  <th>Amount</th>
                  <th>Time Stamp</th>

                </tr>
                </thead>
                <tbody>
<?php $count = 0; ?>
<?php $__currentLoopData = $latestPaid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(!isset($participant->gsmile->user->name)){continue;}?>
<?php if(!isset($participant->rsmile_user->name)){continue;}?>
<?php if(isset($participant->gsmile->user->name) && $participant->gsmile->user->is_pioneer == '1'){continue;}?>
<?php if(isset($participant->rsmile_user->name) && $participant->rsmile_user->is_pioneer == '1'){continue;}?>
<?php if($participant->rsmile_user->id == 393){continue;}?>


                <tr>
                  <td><?php echo e($participant->rsmile_user->name); ?></td>
                  <td><?php echo e($participant->rsmile_user->phone); ?>

                  </td>
                  <td><?php echo e(number_format($participant->amount, 2)); ?></td>
                  <td><?php echo e($participant->updated_at); ?></td>
                </tr>

<?php
if($count > 10) {
  break 1;
}
$count++;
?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">


            </div>


<?php endif; ?>
          </div>
          <!-- /.box -->

            </div>
          </div>





        </section>


      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>