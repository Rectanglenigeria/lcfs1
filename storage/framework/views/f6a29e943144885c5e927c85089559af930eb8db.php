<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Welcome User</small>
      </h1>
      
    </section>

    <section class="content">
      <!--refereer link-->
          <p class="alert alert-success alert-sm alert-dismissable" style="overflow-x: auto;">
            Your referer link is : <?php echo e(Auth::user()->referer_link); ?>

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

<?php if(!isset($match->gsmile_user->name) || !isset($match->rsmile_user->name) ){
  continue;
}
?>

                <tr>
                    
                
                  <td>
                     <?php echo e($match->gsmile_user->name); ?>

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
                    <?php echo e('Time out.'); ?>

                    <?php elseif($match->payment_status == 3): ?>
                      <?php echo e('0d:0h:0m:0s'); ?>

                     <?php elseif($match->payment_status == 2): ?>
                     <?php echo e('0d:0h:0m:0s'); ?>

                     <?php else: ?>
                    <script type="text/javascript">
                  
                     var timeComponent=window.setInterval(function(){
                    
                    var duration=parseInt(<?php echo e($timeLeftArray[$count]); ?>) * 1000;
                    if(duration <= 0){
                      document.getElementById('time<?php echo e($count); ?>').innerHTML='Time out';
                      window.clearInterval(timeComponent);
                    }
                    if(parseInt(<?php echo e($match->is_extended); ?>)== 1){
                      var allocatedTimeInMs=(48+8)*60*60*1000;
                    }else{
                       var allocatedTimeInMs=(48)*60*60*1000;
                    }
                    var duration1 = new Date(allocatedTimeInMs-((new Date())-(new Date(<?php echo e(strtotime($match->created_at)*1000); ?>))));
                    var days1=duration1.getDate() -1;
                    var hours1=duration1.getHours();
                    var minutes1=duration1.getMinutes();
                    var seconds1=duration1.getSeconds();

                    var flipclockFormat=""+days1+"d:"+hours1+"h:"+minutes1+"m:"+seconds1+"s";
                    document.getElementById('time<?php echo e($count); ?>').innerHTML=flipclockFormat;
                  
                   }, 1000);

                    
                    
                  </script>  

                  <span id="<?php echo e('time'.$count); ?>"></span>

                  <?php endif; ?>

                  </td>
                  <td>

                  <?php if($match->payment_status == 0): ?>
              <label class="label label-default lable-lg">Processing</label>
               <?php elseif($match->payment_status == 1): ?>
               <label class="label label-default lable-lg">Matched</label>
               <?php elseif($match->payment_status == 2): ?>
                <label class="label label-default lable-lg">Paid</label>
              <?php else: ?> 
               <label class="label label-default lable-lg">Confirmed</label>
              <?php endif; ?>
              </td>
              <td>

              <!-- action-->
              <?php if($match->payment_status != 0): ?>

                  <?php if(Auth::user()->id == $match->gsmile_user->id): ?>
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
                  <th>Date | Time Left</th>
                  <th>Status | Action</th>
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


                                
                <tr>
                  <td><?php echo e($transaction->gsmile_user->name); ?></td>
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

              



<?php $__currentLoopData = $referees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($referee->referee_user->name); ?></td>
                  <td><?php echo e($referee->created_at); ?>

                  </td>
                </tr>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

                </tr>
                </thead>
                <tbody>
<?php $count = 0; ?>
<?php $__currentLoopData = $latestPaid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $participant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(!isset($participant->gsmile_user->name)){continue;}?>
<?php if($count >= 5) {
  break;
  }?>
                <tr>
                  <td><?php echo e($participant->gsmile_user->name); ?></td>
                  <td><?php echo e($participant->gsmile_user->phone); ?>

                  </td>
                  <td><?php echo e(number_format($participant->amount, 2)); ?></td>
                </tr>
          
<?php $count++; ?>
               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               <?php echo e($latestPaid->links()); ?>

            </center>

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