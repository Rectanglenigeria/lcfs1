@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    




    <section class="content">


 <!--refereer link-->
          <p class="alert alert-info alert-sm alert-dismissable" style="overflow-x: auto;">
          <?php
          $phone = base64_encode(Auth::user()->phone);
          $refLink="https://laughtercommunity.com/referrer/".$phone;
           ?>
            Your referrer link is : {{$refLink}}
          </p>
        <!--refereer link-->
     @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

        <div class="">

                <center><a href="{{URL::to('/gsmile/create')}}"><button type="button" class="btn bg-olive btn-flat margin">Sow Laughter</button></a>

                <a href="{{URL::to('/rsmile/create')}}"><button type="button" class="btn bg-olive btn-flat margin">Reap Laughter</button></a></center>

        </div>

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

              <li class="pull-left header"><i class="fa fa-inbox"></i> Match list</li>
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
                  <th>Sower</th>
                  <th>Reaper</th>
                  <th>Amount</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
<?php $count=0?>
@foreach ($matches as $match)

<?php if(!isset($match->gsmile->user->name) || !isset($match->rsmile_user->name) ){
  continue;
}
?>

                <tr>


                  <td>
                     {{$match->gsmile->user->name}}
                  </td>
                  <td>
                    {{$match->rsmile_user->name}}
                  </td>
                  <td>

                  {{number_format($match->amount,2)}}

                  </td>
                  <td>
                    <!--{{$match->created_at}} |-->

@if($timeLeftArray[$count] <= 0)
                    {{'----'}}
                    @elseif($match->payment_status == 3)
                      {{'0d:0h:0m:0s'}}
                     @elseif($match->payment_status == 2)
                     {{'0d:0h:0m:0s'}}
                     @else







                  <?php


                    $duration=$timeLeftArray[$count];
                  /*  if($duration <= 0){
                     echo '----';
                   }*/

                    if(intval($match->is_extended)== 1){
                      $allocatedTimeInMs=(48)*60*60;
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
                  </td>
                  <td>

                  @if($match->payment_status == 0)
              <label class="label label-default lable-lg">Processing</label>
               @elseif($match->payment_status == 1)
               <label class="label label-default lable-lg">Matched</label>
               @elseif($match->payment_status == 2)
                <label class="label label-default lable-lg">Awaiting confirmation</label>
              @else
               <label class="label label-default lable-lg">Confirmed</label>
              @endif
              </td>
              <td>

              <!-- action-->
              @if($match->payment_status != 0)

                  @if(Auth::user()->id == $match->gsmile->user->id)
               <a class="btn btn-primary btn-sm" href="{{URL::to('/matches/view/'.$match->id)}}">View</a>
                @endif

                 @if(Auth::user()->id == $match->rsmile_user->id)
               <a class="btn btn-primary btn-sm" href="{{URL::to('/matches/viewrs/'.$match->id)}}">View</a>
                @endif

              @endif

                  </td>



                </tr>
    <?php $count ++;?>

 @endforeach

                </tbody>
                <tfoot>
                <tr>
                   <th>Sower</th>
                  <th>Reaper</th>
                  <th>Amount</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$matches->links()}}
            </center>

            </div>

          </div>
          <!-- /.box -->



            </div>
          </div>
        </section>
        <section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Transaction list</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sower</th>
                  <th>Reaper</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
      @foreach($transactions as $transaction)

                  <?php
                      if(!isset($transaction->gsmile->user->name)){
                        continue;
                      }

                      if(!isset($transaction->rsmile_user->name)){
                        continue;
                      }
                  ?>

                <tr>
                  <td>{{$transaction->gsmile->user->name}}</td>
                  <td>{{$transaction->rsmile_user->name}}</td>
                  <td>{{number_format($transaction->amount,2)}}</td>

                </tr>

      @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Sower</th>
                  <th>Reaper</th>
                  <th>Amount</th>

                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$transactions->links()}}
            </center>

            </div>
          </div>
          <!-- /.box -->


            </div>
          </div>


        <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Referrer list preview</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->

              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Referree's Name</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>




@if(!empty($referees))

@foreach($referees as $referee)
<?php if(!isset($referee->referee_user->name)){
  continue;
}
?>    <tr>
                  <td>{{$referee->referee_user->name}}</td>
                  <td>{{$referee->created_at}}
                  </td>
                </tr>

  @endforeach

  @endif
                </tbody>
                <tfoot>
                <tr>
                  <th>Sower</th>
                  <th>Reaper</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$referees->links()}}
            </center>

            </div>

          </div>
          <!-- /.box -->

            </div>
          </div>





        </section>

<section class="col-lg-6 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i>Latest news</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <ul class="timeline">


         <?php $count =1;?>
        @foreach($newsfeeds as $news)
          <?php
            if($count >1){
              break;
            }
          ?>
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    {{date('F d, Y', strtotime($news->updated_at))}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{date('h:i',strtotime($news->updated_at))}}</span>

                <h3 class="timeline-header"><a href="#">Title</a>: {{$news->title}}</h3>

                <div class="timeline-body">
                  {{substr($news->body, 0, 250)}}
                   @if(strlen($news->body)==250)
                   {{'.'}}
                   @else
                   {{'...'}}
                   @endif
                </div>
                <div class="timeline-footer">
                  @if(strlen($news->body)==250)
                   {{null}}
                   @else
                  <a class="btn btn-primary btn-xs" href="{{URL::to('/news/view/'.$news->id)}}">Read more</a>
                  @endif
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <?php $count++;?>
@endforeach



            </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


            </div>
          </div>


        <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Latest paid participants</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->

              <div class="box">

@if(!empty($latestPaid))
            <div class="box-header">

            </div>
            <!-- /.box-header -->
           <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>

                  <th>Name</th>


                  <th>Phone</th>
                  <th>Amount</th>
                  <th>Time</th>

                </tr>
                </thead>
                <tbody>
<?php $count = 0; ?>
@foreach($latestPaid as $participant)

<?php if(!isset($participant->gsmile->user->name)){continue;}?>
<?php if(!isset($participant->rsmile_user->name)){continue;}?>
<?php if(isset($participant->gsmile->user->name) && $participant->gsmile->user->is_pioneer == '1'){continue;}?>
<?php if(isset($participant->rsmile_user->name) && $participant->rsmile_user->is_pioneer == '1'){continue;}?>
<?php if($participant->rsmile_user->id == 393){continue;}?>


                <tr>
                  <td>{{$participant->rsmile_user->name}}</td>
                  <td>{{$participant->rsmile_user->phone}}
                  </td>
                  <td>{{number_format($participant->amount, 2)}}</td>
                  <td>{{$participant->updated_at}}</td>
                </tr>

<?php
if($count > 10) {
  break 1;
}
$count++;
?>
               @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">


            </div>


@endif
          </div>
          <!-- /.box -->

            </div>
          </div>





        </section>


      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()
