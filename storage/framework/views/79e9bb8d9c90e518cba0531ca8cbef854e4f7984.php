<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp; Select Smiles</small>
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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Unmatched Smiles of Age 1 - 15 Day(s)
              &nbsp;<!--<span class="badge"><?php echo e($UmatchedSmilesNo); ?></span>--></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             


<div class="box">
            <div class="box-header">
               <p class="h3" style="float: left;">
       <span>Receiver's Name : <?php echo e(ucwords($RsName)); ?>&nbsp;|&nbsp;</span>
       <span class="RsAmount" id="RsAmount">Amount: <?php echo e(number_format($RsAmount,2)); ?></span><span>&nbsp;Naira</span>
      </p>
            </div>
            <!-- /.box-header -->

            <form method="POST" action="<?php echo e(URL::to('/admin/matches/create')); ?>" name="gsmile_form" role="form">

            <div class="box-body table-responsive no-padding">

            
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="RsId" value="<?php echo e($RsId); ?>">
              <table class="table table-hover">
                <tbody>

                <tr>
                   <th>Giver's Name</th>
                  <th>Unmatched Amount (Naira)</th>
                  <th>Request Age (Days)</th>
                  <th>Select</th>
                </tr>


                <?php $__currentLoopData = $UmatchedSmiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <?php

              $ageInMilliSecs=intval(time())-intval(strtotime($smile->created_at));
              $ageInDays=floor($ageInMilliSecs/(60*60*24));
              ?>

              <?php if($ageInDays < 1 || $ageInDays > 15){
                continue;
              }
              ?>


                <tr>
                  <td><?php echo e($smile->user->name); ?></td>
                  <td>
                  <input type="hidden" name="amount<?php echo e($smile->id); ?>" id="amount<?php echo e($smile->id); ?>" value="<?php echo e($smile->left_amount); ?>">
                  <?php echo e(number_format($smile->left_amount,2)); ?>

                  <!--<?php echo e(number_format($smile->left_amount,2)); ?>&nbsp;from&nbsp;
                  <?php echo e(number_format($smile->amount,2)); ?>-->
                  </td>
                  <td>
                  <?php echo e($ageInDays); ?>

                  </td>

                  <td> 

				           <input name="<?php echo e($smile->id); ?>" type="checkbox" class="" id="<?php echo e($smile->id); ?>"" onclick="updateRsAmount(this.id)">
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


              </table>

             
              

             
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