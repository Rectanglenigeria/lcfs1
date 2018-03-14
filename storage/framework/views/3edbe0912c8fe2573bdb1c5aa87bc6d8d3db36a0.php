<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Inbox</small>
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
 
      <div class="row">
      
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> All messages</span></li>
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
                   <th>Name</th>
                  <th>Title</th>
                  <th>Message</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>


                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                  <td><?php echo e($message->name); ?></td>
                  <td>
                  <?php echo e($message->title); ?>

                  </td>
                  <td><?php echo e(substr($message->body,0,20)."..."); ?></td>

                  <td> 

			         <?php echo e($message->created_at); ?>

              	</td>


              	<td>
              <!-- action-->

<a href="<?php echo e(URL::to('admin/message/view/'.$message->id)); ?>" class="btn btn-primary btn-sm" role="button">View</a>
              
             
             

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




              </tbody></table>

              <?php echo e($messages->links()); ?>

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