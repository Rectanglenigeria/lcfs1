<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;News</small>
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

      <div>
   <a href="<?php echo e(URL::to('/admin/news/list')); ?>" class="btn btn btn-danger">Back</a>
</div>

<br>

      <div class="row">
      
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Create news</span></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             























<div class="box">
            <div class="box-header">
              
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <form role="form" action="<?php echo e(URL::to('/admin/news/create')); ?>" method="POST">
                <!-- text input -->
    <?php echo e(csrf_field()); ?>


                <div class="form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                  <label>Title</label>
                  <input type="text" class="form-control" placeholder="Enter title" name="title" value="<?php echo e(old('title')); ?>">

                  <?php if($errors->has('title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                </div>
                
                <!-- textarea -->
                <div class="form-group<?php echo e($errors->has('body') ? ' has-error' : ''); ?>">
                  
                 <textarea name="body" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                   
<?php echo e(old('body')); ?>

                 </textarea>

                 <?php if($errors->has('body')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('body')); ?></strong>
                                    </span>
                                <?php endif; ?>
               </div>



                <!-- input states -->
                <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
           </form>
            </div>
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