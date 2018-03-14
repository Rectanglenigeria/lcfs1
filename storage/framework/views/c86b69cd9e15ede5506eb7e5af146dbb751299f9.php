<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Achieved Matches</small>
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
      <a style="float: right;" href="<?php echo e(URL::to('/admin/dashboard')); ?>" class="btn btn-success">Back</a>
      <div class="row">
      
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Matches
              &nbsp;<span class="badge"><?php echo e($achievedMatchNo); ?></span></li>
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
                  <th>Giver's Name | Phone</th>
                   <th>Receiver's Name | Phone</th>
                  <th>Amount (Naira)</th>
                  <th>Match Date</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>

                <tbody>
  <?php $count=0?>
               <?php $__currentLoopData = $matches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $match): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                  if($match->rsmile_user->id == 393){
                    continue;
                  }
               ?>


               <?php
                  if(!isset($match->gsmile_user->name)){
                  continue;
                  }

               ?>


               <?php
                  if(!isset($match->rsmile_user->name)){
                  continue;
                  }

               ?>

                <tr>
                  <td><?php echo e($match->gsmile_user->name); ?>&nbsp;|&nbsp;<?php echo e($match->gsmile_user->phone); ?></td>
                  <td><?php echo e($match->rsmile_user->name); ?>&nbsp;|&nbsp;<?php echo e($match->rsmile_user->phone); ?></td>
                  <td><?php echo e(number_format($match->amount,2)); ?>

                  </td>
                  <td><?php echo e($match->created_at); ?></td>
                  <td>
                    
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
                      var allocatedTimeInMs=(48+6)*60*60*1000;
                    }else{
                       var allocatedTimeInMs=(48)*60*60*1000;
                    }
                    var duration1 = new Date(allocatedTimeInMs-((new Date())-(new Date(<?php echo e(strtotime($match->created_at)*1000); ?>))));
                    var days1=duration1.getDate()-1;
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
                <label class="label label-default lable-lg">Paid & Awaiting confirmation</label>
              <?php else: ?> 
               <label class="label label-default lable-lg">Confirmed</label>
              <?php endif; ?>
              </td>

              <td>

              <!-- action-->
             <?php if($match->payment_status == 1 || $match->payment_status == 2): ?>
              <?php if($match->rsmile_user->email != "fadahunsi@gmail.com"): ?>
              <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('admin/matches/unmatch/'.$match->id)); ?>">
              Unmatch
              </a>
              <?php endif; ?>

              <?php endif; ?>
              

              

                  </td>
                  
                </tr>
<?php $count++;?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                </tbody>
                <tfoot>
                <tr>
                   <th>Giver's Name | Phone</th>
                   <th>Receiver's Name | Phone</th>
                  <th>Amount (Naira)</th>
                  <th>Match Date</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>


               <?php echo e($matches->links()); ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


              
            </div>
          </div>
        </section>







        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
























		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>