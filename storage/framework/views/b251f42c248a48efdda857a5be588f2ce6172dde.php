<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Receive Smile list</small>
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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Smiles
              &nbsp;<span class="badge"><?php echo e($achievedSmilesNo); ?></span></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             


<div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody>

                <tr>
                   <th>Giver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>


                <?php $__currentLoopData = $achievedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                  <td><?php echo e($smile->user->name); ?></td>
                  <td><?php echo e(number_format($smile->amount,2)); ?>

                  </td>
                  <td><?php echo e($smile->created_at); ?></td>

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
             

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </tbody></table>

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