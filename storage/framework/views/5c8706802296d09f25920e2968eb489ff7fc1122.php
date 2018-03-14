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

              <strong><i class="fa fa-book margin-r-5"></i>Giver's Name</strong>

              <p class="text-muted">
               <?php echo e($match->gsmile_user->name); ?>

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Phone</strong>

              <p class="text-muted"><?php echo e($match->gsmile_user->phone); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Account Name</strong>

              <p class="text-muted"><?php echo e($match->gsmile_user->account_name); ?></p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Account Number</strong>

              <p class="text-muted"><?php echo e($match->gsmile_user->account_no); ?></p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Giver's Bank</strong>

              <p class="text-muted"><?php echo e(ucwords($match->gsmile_user->bank)); ?>&nbsp; Bank</p>

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

                    var flipclockFormat=""+days1+"d:"+hours1+"h:"+minutes1+"m:"+seconds1+"s";

                    //document.write(flipclockFormat);
                   // window.alert(flipclockFormat);
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
               <?php if($match->is_extended == 0): ?>
               <a class="btn btn-default" href="<?php echo e(URL::to('/matches/extend_time/'.$match->id)); ?>">Extend time (8 hrs)</a>

               <?php endif; ?>
               <?php endif; ?>



               <hr>


               <?php
                if(!isset($match->confirmation->teller_link)){
                  $disabled='disabled';
                  $teller_link=null;

                }

                if(isset($match->confirmation->teller_link)){
                    if($match->confirmation->teller_link != null){
                       $disabled=null;
                       $teller_link=$match->confirmation->teller_link;

                    }else{
                      $disabled='disabled';
                      $teller_link=null;
                    }
                }
               ?>
               <!--view payment teller-->
                <a class="btn btn-md btn-danger <?php echo e($disabled); ?>" href="<?php echo e(asset('public/uploads/'.$teller_link)); ?>" target='_blank' >View payment teller</a>
               <!--view payemnt teller-->


   <?php if($match->payment_status==3): ?>
   <?php echo e(null); ?>

   <?php else: ?>
          <span>
          <a class="btn btn-md btn-info <?php echo e($disabled); ?>" href="<?php echo e(URL::to('/matches/fakeReceipt/'.$match->id)); ?>">Fake receipt</a></span>
        <span>

        <hr>
        <?php if(isset($match->confirmation->teller_link)): ?>
        <form action="<?php echo e(URL::to('/matches/confirmpayment')); ?>" method="POST">
          <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
          <input type="hidden" name="matchId" value="<?php echo e($match->id); ?>">
          <button class="btn btn-md btn-primary <?php echo e($disabled); ?>" name="submit" type="submit">Confirm payment</button>
        </form>
        <?php endif; ?>

        </span>

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