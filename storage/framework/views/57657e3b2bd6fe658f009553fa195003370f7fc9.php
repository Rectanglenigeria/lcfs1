

<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Fast track smiles</small>
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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Confirmed GS
              &nbsp;<span class="badge"><?php echo e($achievedSmilesNo); ?></span></li>
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
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                 <!-- <th>20% Conf.</th>-->
                 <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>

                <tbody>

               <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

               <?php
                if($smile->hidden == 1){continue;}
                  if($smile->id== 184 || $smile->id== 185){continue;}
               ?>

               <?php
                    if(!isset($smile->user->name)){
                      continue;
                    }
                ?>
                <tr>
                  <td><?php echo e($smile->user->name); ?></td>
                  <td><?php echo e(number_format($smile->amount,2)); ?>

                  </td>
                  <td><?php echo e($smile->created_at); ?></td>

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

                    </td>
                    <td>
              <!-- action-->
              <?php if($status=='Available' && !isset($smile->rsmile->id)): ?>
              <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('admin/fasttrack/stage/'.$smile->id)); ?>">Stage smile</a>
              <?php endif; ?>

              <?php if($status=='Pending'): ?>
              <a class="btn btn-primary btn-sm "  href="<?php echo e(URL::to('admin/fasttrack/stage/'.$smile->id)); ?>" disabled='disabled'>Stage Smile</a>
              <?php endif; ?>

             
              
             

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                </tbody>
                <tfoot>
                <tr>
                   <th>Giver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                  <!--<th>20% Conf. Date</th>-->
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>


               <?php echo e($achievedSmiles->links()); ?>

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