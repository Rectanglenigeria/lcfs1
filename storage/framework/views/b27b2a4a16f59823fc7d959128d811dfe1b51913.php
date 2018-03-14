<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bonuses
       
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
              <li class="pull-left header"><i class="fa fa-inbox"></i> Referrer</li>
            </ul>


            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              


               <table class="table table-hover">
                <tbody>

                <tr>
                   <th>Referree's name</th>
                  <!--<th>GS amount</th>-->
                  <th>Bonus (Naira)</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>


                <?php $__currentLoopData = $refererBonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                  <td><?php echo e($bonus->referee->name); ?></td>
                  <!--<td>
                  </td>-->
                  <td><?php echo e(number_format($bonus->amount,2)); ?></td>

                  <td> 
                  <?php echo e($bonus->created_at); ?>

        
                </td>


                <td>
              <!-- action-->

              <?php if($bonus->has_cashed_out ==1 ): ?>
              <?php echo e(null); ?>


              <?php else: ?>
              <a href="<?php echo e(URL::to('bonus/referer/receive/'.$bonus->id)); ?>" class="btn btn-primary btn-sm" role="button">Reap</a>
              <?php endif; ?>
             

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </tbody></table>

              <?php echo e($refererBonuses->links()); ?>






            </div>

            </div>







          </div>


             <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Video</li>
            </ul>


            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              

<table class="table table-hover">
                <tbody>

                <tr>
                   <th>RS aamount (Naira)</th>
                  <th>Bonus (5% of RS)</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>


                <?php $__currentLoopData = $videoBonuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bonus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                  <td><?php echo e(number_format($bonus->rsmile->amount,2)); ?></td>
                  <td><?php echo e(number_format($bonus->amount,2)); ?>

                  </td>
                  <td><?php echo e($bonus->created_at); ?></td>

                  <td> 

                <td>
              <!-- action-->
              <?php if($bonus->has_cashed_out ==1 ): ?>
              <?php echo e(null); ?>


              <?php else: ?>
              <a href="<?php echo e(URL::to('bonus/video/receive/'.$bonus->id)); ?>" class="btn btn-primary btn-sm" role="button">Reap</a>
              <?php endif; ?>
             
             

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </tbody></table>

              <?php echo e($videoBonuses->links()); ?>





            </div>

            </div>







          </div>

        </section>







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