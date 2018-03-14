@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Achieved Matches</small>
      </h1>
         </section>


    <section class="content">


    @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif


      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <a style="float: right;" href="{{URL::to('/admin/dashboard')}}" class="btn btn-success">Back</a>
      <div class="row">

        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">



          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Matches
              &nbsp;<span class="badge">{{$achievedMatchNo}}</span></li>
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

                  <th>S/N</th>
                  <th>Giver's Name | Phone</th>

                   <th>Receiver's Name | Phone</th>
                  <th>Amount (Naira)</th>
                  <th>Match Date</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
                </thead>

                <tbody>
  <?php $count=1;?>
               @foreach($matches as $match)

                <?php
                  if($match->rsmile_user_id == 393 || $match->rsmile_user_id == 319 || $match->rsmile_user_id == 605 ){
                    continue;
                  }
               ?>


               <?php
                  if(!isset($match->gsmile->user->name)){
                  continue;
                  }

               ?>


               <?php
                  if(!isset($match->rsmile_user->name)){
                  continue;
                  }

               ?>

                <tr>
                  <td>
                    @if($match->payment_status==2)

                            <form action="{{URL::to('admin/matches/confirmpayment')}}" method="POST">
                              <input type="hidden" name="_token" value="{{csrf_token()}}">
                              <input type="hidden" name="matchId" value="{{$match->id}}">
                              <button class="btn btn-xs" name="submit" type="submit">
                            {{$count}}</button>
                            </form>
                      @else

                      <a class="btn btn-xs" type="button">
                    {{$count}}</a>
                      @endif
                    </td>
                    <td>
                    {{$match->gsmile->user->name}}&nbsp;|&nbsp;{{$match->gsmile->user->phone}}</td>
                  <td>{{$match->rsmile_user->name}}&nbsp;|&nbsp;{{$match->rsmile_user->phone}}</td>
                  <td>{{number_format($match->amount,2)}}
                  </td>
                  <td>{{$match->created_at}}</td>
                  <td>

                    @if($timeLeftArray[$count] <= 0)
                    {{'Time out.'}}
                    @elseif($match->payment_status == 3)
                      {{'0d:0h:0m:0s'}}
                     @elseif($match->payment_status == 2)
                     {{'0d:0h:0m:0s'}}
                     @else
                    <script type="text/javascript">

                     var timeComponent=window.setInterval(function(){

                    var duration=parseInt({{$timeLeftArray[$count]}}) * 1000;
                    if(duration <= 0){
                      document.getElementById('time{{$count}}').innerHTML='Time out';
                      window.clearInterval(timeComponent);
                    }
                    if(parseInt({{$match->is_extended}})== 1){
                      var allocatedTimeInMs=(48 6)*60*60*1000;
                    }else{
                       var allocatedTimeInMs=(48)*60*60*1000;
                    }
                    var duration1 = new Date(allocatedTimeInMs-((new Date())-(new Date({{strtotime($match->created_at)*1000}}))));
                    var days1=duration1.getDate()-1;
                    var hours1=duration1.getHours();
                    var minutes1=duration1.getMinutes();
                    var seconds1=duration1.getSeconds();

                    var flipclockFormat="" days1 "d:" hours1 "h:" minutes1 "m:" seconds1 "s";
                    document.getElementById('time{{$count}}').innerHTML=flipclockFormat;

                   }, 1000);



                  </script>

                  <span id="{{'time'.$count}}"></span>

                  @endif

                  </td>

                  <td>

				@if($match->payment_status == 0)
              <label class="label label-default lable-lg">Processing</label>
               @elseif($match->payment_status == 1)
               <label class="label label-default lable-lg">Matched</label>
               @elseif($match->payment_status == 2)
                <label class="label label-default lable-lg">Paid & Awaiting confirmation</label>
              @else
               <label class="label label-default lable-lg">Confirmed</label>
              @endif
              </td>

              <td>

              <!-- action-->
             @if($match->payment_status == 1 || $match->payment_status == 2)
              @if($match->rsmile_user->email != "fadahunsi@gmail.com")
              <a class="btn btn-success btn-sm" href="{{URL::to('admin/matches/unmatch/'.$match->id)}}">
              Unmatch
              </a>
              @endif

              @endif




                  </td>

                </tr>
<?php $count++;?>
                @endforeach





                </tbody>
                <tfoot>
                <tr>
                  <th>S/N</th>
                   <th>Giver's Name | Phone</th>

                   <th>Receiver's Name | Phone</th>
                  <th>Amount (Naira)</th>
                  <th>Match Date</th>
                  <th>Time Left</th>
                  <th>Status</th>
                  <th>Action</th>

                </tr>
                </tfoot>
              </table>


               {{$matches->links()}}
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
























		@endsection
