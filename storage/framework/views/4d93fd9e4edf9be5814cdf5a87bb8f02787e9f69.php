

<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAUGHTER COMMUNITY
        <small>Dashboard&nbsp;|&nbsp;RL list</small>
      </h1>
         </section>


    <section class="content">


    <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


<div class="alert alert-info alert-sm alert-dismissable">
            <span>Quick Tutorial: </span>
            <ol>
            <li>
               Match RS requests to SL requests. This page lists out unmatched RL requests and partially matched RL requests.
            </li>

            <li>
               The manual matching is independent on 10 days period.
            </li>

            </ol>


          </div>

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


          <br>
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i>

              Unmatched and Partially Matched RL Requests

              </li>
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
                   <th>Sower's Name</th>
                  <th>RL Value (Naira)</th>
                  <th>Matched Amount (Naira)</th>
                  <th>Amount Left (Naira)</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>

                <tbody>

              <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                    if(!isset($smile->user->id)){
                      continue;
                    }
                ?>
                <?php

                   if($smile->user->is_block == '1'){
                continue;
              }

              if($smile->user->id==37 || $smile->user->id==40){
                continue;
              }

              if($smile->user->id == 393){continue;}

              if($smile->left_amount <= 0){
                continue;  // skip fully matched request
              }


                ?>

                <tr>
                  <td><?php echo e($smile->user->name); ?></td>
                  <td><?php echo e(number_format($smile->amount,2)); ?>

                   <td><?php echo e(number_format(($smile->amount-$smile->left_amount),2)); ?>

                    <td><?php echo e(number_format($smile->left_amount,2)); ?>

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
                  <?php if($smile->left_amount == 0): ?>
                  <label class="label label-default lable-lg">Fully matched</label>
                  <?php elseif($smile->left_amount > 0 && $smile->left_amount < $smile->amount): ?>
                  <label class="label label-default lable-lg">Partially matched</label>
                  <?php elseif($smile->left_amount == $smile->amount ): ?>
                  <label class="label label-default lable-lg">Not matched</label>
                  <?php endif; ?>
                </td>
                <td>
              <!-- action-->
              <?php if($smile->left_amount > 0): ?>
              <a class="btn btn-success btn-sm" href="<?php echo e(URL::to('admin/matches/select_gs_users/'.$smile->id)); ?>">Match</a>
              <?php endif; ?>



               <a class="btn btn-primary btn-sm" href="<?php echo e(URL::to('admin/rsmile/view/'.$smile->id)); ?>">View</a>


               <?php if($smile->left_amount==$smile->amount): ?>
               <a class="btn btn-danger btn-sm" href="<?php echo e(URL::to('admin/rsmile/delete/'.$smile->id)); ?>">Delete</a>
               <?php endif; ?>


                  </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>






                </tbody>
                <tfoot>
                <tr>
                   <th>Sower's Name</th>
                  <th>RL Value (Naira)</th>
                  <th>Matched Amount (Naira)</th>
                  <th>Amount Left (Naira)</th>
                  <th>Date</th>
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



<div class="col-md-12 col-sm-12 col-lg-12 col-xs-12">

            <div class="panel-group" id="accordion">



  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Fully Matched RS Requests
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body table-responsive no-padding">
        <table class="table table-hover">
                <tbody>

                <tr>
                   <th>Giver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>


                <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php
                  if($smile->left_amount > 0){
                    continue;
                  }

                  if($smile->left_amount < 0){
                    continue;
                  }
                ?>


                <?php

                if(!isset($smile->user->id)){
                  continue;
                }
                   if($smile->user->is_block == 1){
                continue;
              }




              if($smile->user->id==37 || $smile->user->id==40 || $smile->user->id == 393){
                continue;
              }

              if($smile->left_amount > 0 && $smile->left_amount <= $smile->amount ){
                continue;  // skip fully matched request
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
                  <?php if($smile->left_amount == 0): ?>
                  <label class="label label-default lable-lg">Fully matched</label>
                  <?php elseif($smile->left_amount > 0 && $smile->left_amount < $smile->amount): ?>
                  <label class="label label-default lable-lg">Partially matched</label>
                  <?php elseif($smile->left_amount == $smile->amount ): ?>
                  <label class="label label-default lable-lg">Not matched</label>
                  <?php endif; ?>
                </td>
                <td>
              <!-- action-->


               <a class="btn btn-primary btn-sm" href="<?php echo e(URL::to('admin/rsmile/view/'.$smile->id)); ?>">View</a>


                  </td>

                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </tbody></table>

              <?php echo e($achievedSmiles->links()); ?>


      </div>
    </div>
  </div>






</div>

          </div>





        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
























		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>