<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp; Select Smiles</small>
      </h1>
         </section>

         <div class="alert alert-info alert-sm alert-dismissable">
            <span>Quick Tutorial: </span>
            <ol>
            <li>
               Select GS request or group of GS requests to be matched with selected RS.
               
            </li>

            <li>
               This is an attempt to completely or partially match 80% of GS request(s).
            </li>

            <li>
              The matching is real-time.
            </li>

            </ol>
            
           
          </div>


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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Umatched 80% GS Requests
              &nbsp;<!--<span class="badge"><?php echo e($UmatchedSmilesNo); ?></span>--></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             


<div class="box">
            <div class="box-header">
               <p class="h3" style="float: left;">
       <span>Receiver's Name : <?php echo e(ucwords($RsName)); ?>&nbsp;|&nbsp;</span>
       <span class="RsAmount" id="RsAmount">Amount Left: <?php echo e(number_format($RsAmount,2)); ?></span><span>&nbsp;Naira</span>
      </p>
            </div>
            <!-- /.box-header -->

            <form method="POST" action="<?php echo e(URL::to('/admin/matches/create')); ?>" name="gsmile_form" role="form">

            <div class="box-body table-responsive no-padding">

            
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="RsId" value="<?php echo e($RsId); ?>">




















<!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <thead>
               <tr>
                   <th>Giver's Name</th>
                   <th>GS Value (Naira)</th>
                   <th>Matched Amount (Naira)</th>
                  <th>Left Amount (Naira)</th>
                  <th>Request Age (Days)</th>
                  <th>Type</th>
                  <th>Deduct</th>
                </tr>
                </thead>

                <tbody>

            <?php $__currentLoopData = $UmatchedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php

                if(!isset($smile->user->id)){
                  continue;
                }

                  $smileLeftAmount=$smile->left_amount;
                  $confirmations=$smile->confirmation;

                  if($smile->user_id == 393){continue;}



                  foreach ($confirmations as $key => $confirm) {

                   // echo json_encode($confirm);

                    if(empty($confirm)){
                      continue;
                    }

                    if($confirm->payment_type == 0 && $confirm->payment_status==3){
                      $insurancePaid=1;
                    }else{
                      $insurancePaid=0;
                    }
                  }

                  if(isset($insurancePaid) && $insurancePaid == 0){
                    continue;
                  }

                ?>

              <?php

              if($smile->user->is_block == '1'){
                continue;
              }

              if($smile->user_id==37 || $smile->user_id==40){
                continue;
              }

              if($smile->left_amount==0){
                continue;
              }

              $ageInMilliSecs=intval(time())-intval(strtotime($smile->created_at));
              $ageInDays=floor($ageInMilliSecs/(60*60*24));
              

              
              ?>


                <tr>
                  <td><?php echo e($smile->user->name); ?></td>
                  <td><?php echo e(number_format($smile->amount,2)); ?></td>
                  <td><?php echo e(number_format(($smile->amount-$smile->left_amount),2)); ?></td>
                  <td>
               
                  <?php echo e(number_format($smile->left_amount,2)); ?>

                  <!--<?php echo e(number_format($smile->left_amount,2)); ?>&nbsp;from&nbsp;
                  <?php echo e(number_format($smile->amount,2)); ?>-->
                  </td>
                  <td>
                  <?php echo e($ageInDays); ?>

                  </td>

                  <td>
                    <?php if($smile->user->is_pioneer==1): ?>
                    <label class="label label-sm label-success">Pioneer</label>
                    <?php endif; ?>

                    <?php if($smile->user->is_pioneer==0): ?>
                    <label class="label label-sm label-info">Participant</label>
                    <?php endif; ?>

                    <?php if($smile->user->is_teamlead==1 && $smile->user->is_pioneer==1): ?>
                    <label class="label label-sm label-info">Pioneer | Team lead</label>
                    <?php endif; ?>

                     <?php if($smile->user->is_teamlead==1): ?>
                    <label class="label label-sm label-info">Team lead</label>
                    <?php endif; ?>

                  </td>

                  <td> 

                   <input name="<?php echo e($smile->id); ?>" type="number" class="" id="<?php echo e($smile->id); ?>"" onclick="">
                </td>
                
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <script type="text/javascript">
                var initRsAmount=parseFloat("<?php echo e($RsAmount); ?>");
                function updateRsAmount(smile_id)
                {
                 
                    var toBeSubtracted=parseFloat(document.getElementById("amount"+smile_id).value);
                initRsAmount=initRsAmount - toBeSubtracted;
                  document.getElementById('RsAmount').innerHTML=initRsAmount;
                 

                }

                </script>



                </tbody>
                <tfoot>
                <tr>
                   <th>Giver's Name</th>
                   <th>GS Value (Naira)</th>
                   <th>Matched Amount (Naira)</th>
                  <th>Left Amount (Naira)</th>
                  <th>Request Age (Days)</th>
                  <th>Type</th>
                  <th>Deduct</th>
                </tr>
                </tfoot>
              </table>

               

               
            </div>
            <!-- /.box-body -->
































































             
            </div>
<center>
   <button class="btn btn-primary btn-lg" type="submit" name="submit">Submit</button>
</center>

            


            </form>
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