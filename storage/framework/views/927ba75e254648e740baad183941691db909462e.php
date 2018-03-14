<?php $__env->startSection('content'); ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Matching Details
      </h1>
     
    </section>

    <section class="content">
    <!--refereer link-->
         
        <!--refereer link-->
        <?php if(Session::has('notification')): ?>
          <p class="alert alert-success alert-sm alert-dismissable"><?php echo e(Session::get('notification')); ?></p>
        <?php endif; ?>


    <!-- Main content -->
    <section class="content">

      <div class="row">
          <!-- Left col -->
        <div class="col-lg-2"></div>
        <section class="col-lg-6 connectedSortable">
        <a style="float: right;" href="<?php echo e(URL::to('/home')); ?>" class="btn btn-success">Back</a>

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Payment details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <strong><i class="fa fa-book margin-r-5"></i>Amount</strong>

              <p class="text-muted">
               <?php echo e($match->amount); ?>

              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Receiver's Name</strong>

              <p class="text-muted">
               <?php echo e($match->rsmile_user->name); ?>

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Phone</strong>

              <p class="text-muted"><?php echo e($match->rsmile_user->phone); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Account Name</strong>

              <p class="text-muted"><?php echo e($match->rsmile_user->account_name); ?></p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Account Number</strong>

              <p class="text-muted"><?php echo e($match->rsmile_user->account_no); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Receiver's Bank</strong>

              <p class="text-muted"><?php echo e(ucwords($match->rsmile_user->bank)); ?>&nbsp; Bank</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Time Left</strong>

              <p class="text-muted">
                <?php if($match->payment_status == 3): ?>
                      <?php echo e('0d:0h:0m:0s'); ?>

                     <?php elseif($match->payment_status == 2): ?>
                     <?php echo e('0d:0h:0m:0s'); ?>

                     <?php else: ?>
                    <script type="text/javascript">
                     var timeComponent = window.setInterval(function(){
                    
                    var duration=parseInt(<?php echo e($timeLeft); ?>) * 1000;
                    if(duration <= 0){
                      document.getElementById('time').innerHTML='Time out';
                      window.clearInterval(timeComponent);
                    }
                if(parseInt(<?php echo e($match->is_extended); ?>)== 1){
                      var allocatedTimeInMs=(48+8)*60*60*1000;
                    }else{
                       var allocatedTimeInMs=(48)*60*60*1000;
                    }
                    var duration1 = new Date(allocatedTimeInMs-((new Date())-(new Date(<?php echo e(strtotime($match->created_at)*1000); ?>))));
                    var days1=duration1.getDate()-1;
                    var hours1=duration1.getHours();
                    var minutes1=duration1.getMinutes();
                    var seconds1=duration1.getSeconds();

                    var flipclockFormat=""+days1+" D :"+hours1+" H :"+minutes1+" M :"+seconds1+" S";
                    document.getElementById('time').innerHTML=flipclockFormat;
                   }, 1000);

                    
                    
                  </script>  
                  <span class="h" id='time'></span>
                  <?php endif; ?>

              </p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

                <?php if($match->payment_status == 0): ?>
              <label class="label label-default lable-md">Processing</label>
               <?php elseif($match->payment_status == 1): ?>
               <label class="label label-default lable-md">Matched</label>
               <?php elseif($match->payment_status == 2): ?>
                <label class="label label-default lable-md">Paid</label>
              <?php else: ?> 
               <label class="label label-default lable-md">Confirmed</label>
              <?php endif; ?>

            
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>


               <?php if($match->payment_status == 1): ?>

               <!--kudi modal-->
               <!-- Button trigger modal -->
<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
  Pay with Kudi.ai (alternative)
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel" style="color:#4682B4;">
       <strong>Kudi.ai | Payment mode | Chat to tranfer fund.</h4>
        </strong>
        <p>Notice: Screenshot and upload Kudi.ai success page as payment teller.</p>
      </div>
      <div class="modal-body">
        <iframe src="https://chat.kudi.ai/" style="height: 400px; width:100%;" frameborder="0">
        </iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>
               <!--kudi modal-->

               <hr>
               <!--upload payment teller-->
               <form action="<?php echo e(URL::to('/matches/uploadteller')); ?>" method="POST" enctype="multipart/form-data">
        <label>Upload payment teller</label>
        <span>
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <input type="hidden" name="matchId" value="<?php echo e($match->id); ?>">
          <input type="hidden" name="matchid" value="<?php echo e($match->id); ?>">
           </span>
           <span>
          <input type="file" name="file" id='file'><br>
          <button class="btn btn-md btn-primary" type="submit">Submit</button>
       </span>
        </form>



               

              <?php endif; ?>

              <?php if($match->payment_status == 2): ?>
                
              <hr>
               <!--view payment teller-->
                <a class="btn btn-md btn-danger" href="<?php echo e(asset('public/uploads/'.$match->confirmation->teller_link)); ?>" target='_blank' >View payment teller</a>
               <!--view payemnt teller-->
                <br>
               <!--upload payment teller-->
               <form action="<?php echo e(URL::to('/matches/uploadteller')); ?>" method="POST" enctype="multipart/form-data">
        <label>Update payment teller</label>
        <span>
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <input type="hidden" name="matchId" value="<?php echo e($match->id); ?>">
          <input type="hidden" name="matchid" value="<?php echo e($match->id); ?>">
           </span>
           <span>
          <input type="file" name="file" id='file'><br>
          <button class="btn btn-md btn-primary" type="submit">Submit</button>
       </span>
        </form>
              <?php endif; ?>



              </p>
            </div>
            <!-- /.box-body -->
          </div>
         
        </section>

        <div class="col-lg-2"></div>




  
      </div>
      <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
          <!-- Map box -->
                        <!-- /. tools -->

                              <!-- ./col -->
            
          <!-- /.box -->

          <!-- Calendar -->
          
               
                <!-- /.col -->
                
                <!-- /.col -->

        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth_pages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>