@extends('layouts.admin_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SL Details
      </h1>
     
    </section>

    <section class="content">
    <!--refereer link-->
         
        <!--refereer link-->
        @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif


    <!-- Main content -->
    <section class="content">

      <div class="row">
          <!-- Left col -->
        <div class="col-lg-2"></div>
        <section class="col-lg-6 connectedSortable">
        <a style="float: right;" href="{{URL::to('/home')}}" class="btn btn-success">Back</a>

        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">SL details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-book margin-r-5"></i>Amount (Naira)</strong>

              <p class="text-muted">
               {{number_format($smile->amount,2)}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Sower's Name</strong>

              <p class="text-muted">
               {{$smile->user->name}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Phone</strong>

              <p class="text-muted">{{$smile->user->phone}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Account Name</strong>

              <p class="text-muted">{{$smile->user->account_name}}</p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Account Number</strong>

              <p class="text-muted">{{$smile->user->account_no}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Bank</strong>

              <p class="text-muted">{{ucwords($smile->user->bank)}}&nbsp; Bank</p>


              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

              <?php 
                      $sumAllMatchesAmount=0;
                      $paymentStatusArray=[];
                      $count=0;
                      foreach($smile->confirmation as $confirmation){
                        $sumAllMatchesAmount+=$confirmation->amount; 
                        $paymentStatusArray[$count]=$confirmation->payment_status;
                        $count++;
                      }

                      if(in_array(0, $paymentStatusArray) || in_array(1, $paymentStatusArray) || in_array(2, $paymentStatusArray)){
                        $paidAll=false;
                      }else{
                        //all are 3s
                        $paidAll=true;
                      }

                      if($smile->amount == $sumAllMatchesAmount && $paidAll ==true){
                        $status='Available';
                        $label='label-success';
                      }else{
                        $status="Pending";
                        $label='label-danger';
                      }
                         
                     ?>


               
                 @if(!isset($smile->rsmile->id))
                    <label class="label label-md {{$label}}">{{$status}}</label>
                    @else
                    <label class="label label-md label-default">Requested</label>
                    @endif

            
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              
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
  @endsection()