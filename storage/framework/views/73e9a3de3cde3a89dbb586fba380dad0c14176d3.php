

<?php $__env->startSection('content'); ?>








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAUGHTER COMMUNINTY
        <small>Dashboard&nbsp;|&nbsp;All Registered Users</small>
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
      <a style="float: right;" href="<?php echo e(URL::to('/admin/dashboard')); ?>" class="btn btn-xs btn-success">Back</a>
      <div class="row">
      
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Registered Users
              &nbsp;<span class="badge"><?php echo e($userNo-1); ?></span></li>
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
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>

                <tbody>

               <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

               <?php
               		if($user->id==101|| $user->id==393){continue;}
               ?>

                <tr>
                  <td><?php echo e($user->name); ?></td>
                  <td><?php echo e($user->phone); ?>

                  </td>
                  <td><?php echo e($user->created_at); ?></td>

                  <td>
                  	<?php if($user->is_pioneer == '1'): ?>
                <span style="float:right;" class="label label-primary label-xs"><?php echo e('Pioneer'); ?></span>
                <?php else: ?>
                <span style="float:right;" class="label label-primary label-xs"><?php echo e('Ordinary user'); ?></span>
                <?php endif; ?>

                <?php if($user->is_active == '1'): ?>
                <span style="float:right;" class="label label-success label-xs"><?php echo e(' verified'); ?></span>
                <?php else: ?>
                <span style="float:right;" class="label label-success label-xs"><?php echo e('not verified '); ?></span>
                <?php endif; ?>

                <?php if($user->is_pioneer == '1'): ?>
                <span style="float:right;" class="label label-info label-xs"><?php echo e('blocked'); ?></span>
                <?php else: ?>
                <span style="float:right;" class="label label-info label-xs"><?php echo e('active'); ?></span>
                <?php endif; ?>
                  </td>

                  <td>
                 <a href="<?php echo e(URL::to('/admin/user/view/'.$user->id)); ?>"  class="btn btn-xs btn-default">View</a>

                  <?php if($user->is_pioneer == '0' || $user->is_pioneer == null): ?>
              <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/make_pioneer/'.$user->id)); ?>">Make pioneer</a>
               <?php else: ?>
               <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_pioneer/'.$user->id)); ?>">Unmake pioneer</a>
              <?php endif; ?>


               <?php if($user->is_teamlead == '0' || $user->is_teamlead == null): ?>
              <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/make_teamlead/'.$user->id)); ?>">Make Legend</a>
               <?php else: ?>
               <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_teamlead/'.$user->id)); ?>">Unmake Legend</a>
              <?php endif; ?>

              <?php if($user->is_early_reaper == '0' || $user->is_early_reaper == null): ?>
              <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/make_el/'.$user->id)); ?>">Make EL</a>
               <?php else: ?>
               <a class="btn btn-xs btn-primary" href="<?php echo e(URL::to('/admin/user/unmake_el/'.$user->id)); ?>">Unmake EL</a>
              <?php endif; ?>
              

              <?php if($user->is_block == '0' || $user->is_block == null): ?>
              <a class="btn btn-xs btn-info" href="<?php echo e(URL::to('/admin/user/block/'.$user->id)); ?>">Block</a>
               <?php else: ?>
               <a class="btn btn-xs btn-info" href="<?php echo e(URL::to('/admin/user/unblock/'.$user->id)); ?>">Unblock</a>
              <?php endif; ?>


              <!--<a class="btn btn-xs btn-danger" href="<?php echo e(URL::to('/admin/user/delete/'.$user->id)); ?>">
              Delete
              </a>-->

                  </td>
                  
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                </tbody>
                <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>


               <?php echo e($users->links()); ?>

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





















<!--

<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					<div class="pull-right">
						
						<ul class="stats">

						<?php if(Auth::guard('admin')->user()->role=='1'): ?>
						
						<li>
							<a  class='btn btn-xs btn-danger' href="<?php echo e(URL::to('/admin/matchlist/blocktimedeclindedusers')); ?>">Block time declined users (all)</a>
						</li>
						
						<?php endif; ?>
							
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big">
										<?php  //echo date('M d, Y'); ?>
									</span>
									<span><?php //echo date('D, h:i a')?></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="more-login.html">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="index-2.html">Dashboard</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#">
							<i class="fa fa-times"></i>
						</a>
					</div>
				</div>



				<div class="row">
					<div class="col-sm-12">
					<?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>

						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-bar-chart-o"></i>
									New registered users
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-xs btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content">

								<table class="table table-user table-nohead">
									<tbody>
										
									<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

										<tr>
											<td class='img'>
												<img src="<?php echo e(asset('/public/img/male_ghost.png')); ?>" alt="">
											</td>
											<td class='user'><?php echo e($user->username); ?>

											<?php if($user->status=='1'): ?>
												<span style="float: right;" class="label label-danger">Blocked</span>
											<?php endif; ?>
											</td>

											<td class='icon'>
												<a class='btn' data-toggle="modal" data-target="#myModal<?php echo e($user->id); ?>">
													<i class="fa fa-search"></i>
												</a>
											</td>

		<div id="myModal<?php echo e($user->id); ?>" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel">User details</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-2">
							<img style="width:100px; height: 100px;" src="<?php echo e(asset('/public/img/male_ghost.png')); ?>" alt="">
						</div>
						<div class="col-sm-10">
							<dl class="dl-horizontal" style="margin-top:0;">
								<dt>Username:</dt>
								<dd><?php echo e($user->username); ?></dd>
								<dt>Email:</dt>
								<dd><?php echo e($user->email); ?></dd>
								<dt>Phone:</dt>
								<dd><?php echo e($user->phone); ?></dd>
								<dt>Account name:</dt>
								<dd><?php echo e($user->accountname); ?></dd>
								<dt>Account no:</dt>
								<dd><?php echo e($user->accountno); ?></dd>
								<dt>Bank:</dt>
								<dd><?php echo e($user->bank); ?></dd>
								<dt>Participant location:</dt>
								<dd><?php echo e($user->location); ?></dd>
								
								
							</dl>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
										</tr>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

										
									
									</tbody>
								</table>

								<?php echo e($users->links()); ?>

								
							</div>
						</div>
					</div>
					
				</div>


				
			</div>
		</div>


		
-->


		<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>