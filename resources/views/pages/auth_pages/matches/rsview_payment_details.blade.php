@extends('layouts.auth_pages')
@section('content')
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
              <h3 class="box-title">Payment details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <strong><i class="fa fa-book margin-r-5"></i>Amount</strong>

              <p class="text-muted">
               {{$match->amount}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Sower's Name</strong>

              <p class="text-muted">
               {{$match->gsmile->user->name}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Phone</strong>

              <p class="text-muted">{{$match->gsmile->user->phone}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Account Name</strong>

              <p class="text-muted">{{$match->gsmile->user->account_name}}</p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Account Number</strong>

              <p class="text-muted">{{$match->gsmile->user->account_no}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Sower's Bank</strong>

              <p class="text-muted">{{ucwords($match->gsmile->user->bank)}}&nbsp; Bank</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Time Left</strong>

              <p class="text-muted">


                @if($timeLeft<= 0)
                    {{'----'}}
                  @elseif($match->payment_status == 3)
                      {{'0d:0h:0m:0s'}}
                     @elseif($match->payment_status == 2)
                     {{'0d:0h:0m:0s'}}
                     @else






                  <?php


                    $duration=$timeLeft;
                  //  if($duration <= 0){
                     //echo 'Time out';
                    //}

                    if(intval($match->is_extended)== 1){
                      $allocatedTimeInMs=(24+24)*60*60;
                    }else{
                       $allocatedTimeInMs=(24)*60*60;
                    }

                    $duration1=$allocatedTimeInMs-(time()-strtotime($match->created_at));




$secondsLeft = $duration1;
$days = floor($secondsLeft / (60*60*24));
$hours = floor ( ($secondsLeft - ($days*60*60*24)) / (60*60) );
$mins =  floor(  ($secondsLeft-($days*60*60*24) - ($hours*60*60))/60);
                  ?>

                  <span> <?php
                        echo $days."D : ".$hours."H : ".$mins."M";
                  ?></span>

                  @endif






              </p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

                @if($match->payment_status == 0)
              <label class="label label-default lable-md">Processing</label>
               @elseif($match->payment_status == 1)
               <label class="label label-default lable-md">Matched</label>
               @elseif($match->payment_status == 2)
                <label class="label label-default lable-md">Awaiting confirmation</label>
              @else
               <label class="label label-default lable-md">Confirmed</label>
              @endif


              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>


               @if($match->payment_status == 1)
               @if($match->is_extended == 0)
               <a class="btn btn-default" href="{{URL::to('/matches/extend_time/'.$match->id)}}">Extend time (24 hrs)</a>

               @endif
               @endif

               @if($timeLeft <= 0)
               <a class="btn btn-danger" href="{{URL::to('/matches/remove_defaulter/'.$match->id)}}">Remove defaulter</a>
               @endif


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

               <?php
                  $fParam=$match->id;
               ?>
                <a class="btn btn-md btn-danger <?php echo $disabled; ?>" href="{{asset('public/uploads/'.$teller_link)}}" target='_blank' >View payment teller</a>
               <!--view payemnt teller-->


   @if($match->payment_status==3)
   {{null}}
   @else
          <span>
          <a class="btn btn-md btn-info {{$disabled}}" href="{{URL::to('/matches/fakeReceipt/'.$match->id)}}">Fake receipt</a></span>
        <span>

        <hr>

@if(isset($match->confirmation->teller_link))

        <form action="{{URL::to('/matches/confirmpayment')}}" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="matchId" value="{{$match->id}}">
          <button class="btn btn-md btn-primary" name="submit" type="submit">Confirm payment</button>
        </form>
  @endif



        </span>

    @endif









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
  @endsection()
