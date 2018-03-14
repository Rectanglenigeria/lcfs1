<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Testimonials / Create
       
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
        <div class="" style="text-align:right;">
          <a class="btn btn-lg btn-success" href="<?php echo e(URL::to('/testimonials/list')); ?>">View testimonies</a>

        </div>
        <br>
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Testimonial</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              <dl class="dl-horizontal">


              <form name="testimony_form" role="form"  action="<?php echo e(URL::to('/testimonials/create')); ?>" method="POST">

                <?php echo e(csrf_field()); ?>


               
                  <div class="form-group<?php echo e($errors->has('smileId') ? ' has-error' : ''); ?>">
                    <label for="inputSkills" class="control-label">Select smile</label>

                    <div>
<?php
 $rsmileIdArray=[]; 
?>

                  <select class="form-control" name="smileId">

                  <option  disabled="disabled" selected="selected">Select smile</option>
                
          <?php 
          foreach($achievedTestimonies as $key => $achieved){
            $rsmileIdArray[$key]=$achieved->rsmile_id;
          }
            ?>
         
                      
           <?php $__currentLoopData = $smiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $smile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           
              <?php if(in_array($smile->id, $rsmileIdArray)): ?>
               <?php
                continue;
               ?>
              <?php else: ?>
            <option value="<?php echo e($smile->id); ?>">
            Amount: <?php echo e(number_format($smile->amount, 2)); ?> Naira on <?php echo e(date('F d, Y', strtotime($smile->updated_at))); ?>

            </option>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </select>

        <?php if($errors->has('smileId')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('smileId')); ?></strong>
                                    </span>
                                <?php endif; ?>
                      


                    </div>
                  </div>



                  <div class="form-group<?php echo e($errors->has('message') ? ' has-error' : ''); ?>">
                  <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                  
                  <textarea id="inputMessage" name="message" class="form-control" rows="5" placeholder="Enter ..."><?php echo e(old('message')); ?>

                  </textarea>
                 
                      <?php if($errors->has('message')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('message')); ?></strong>
                                    </span>
                                <?php endif; ?>
                </div>



               

                
                  <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Testimonial Video</h3>

                      <div class="box-tools pull-right">
                      <button type="button" class="btn btn-sm btn-success" data-widget="collapse">add video link
                    </button>

                  </div>
                <!-- /.box-tools -->
                </div>
            <!-- /.box-header -->
                <div class="box-body">
                  
                 <div class="form-group">
                  <label>Video (upload your video to your youtube channel, copy and paste its link below.)</label>
                  <input id="video_link" name="video_link" type="text" class="form-control" placeholder="Youtube link" value="<?php echo e(old('video_link')); ?>">
                </div>
                </div>
                </div>
              
              
              <button name="submit" type="submit" class="btn btn-danger btn-lg">Submit</button>
                </form>





              </dl>
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