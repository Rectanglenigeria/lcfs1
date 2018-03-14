@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAUGHTER COMMUNITY
        <small>Dashboard&nbsp;|&nbsp;Fast track smiles</small>
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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Confirmed SL
              &nbsp;<span class="badge">{{$achievedSmilesNo}}</span></li>
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
                  <th>Giver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                 <!-- <th>20% Conf.</th>-->
                 <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>

                <tbody>

               @foreach($achievedSmiles as $smile)



                <?php 


                  //skip GSs that have not been completely fulfilled
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




                  <?php

                  //skip requested GSs

                    if(isset($smile->rsmile->id)){
                      continue;
                    }

                  ?>

                 



                <?php

                if($status=='Pending'){
                  continue;
                }

                ?>




               <?php
                if($smile->hidden == 1){continue;}
                  if($smile->id== 184 || $smile->id== 185){continue;}
               ?>

               <?php
                    if(!isset($smile->user->name)){
                      continue;
                    }
                ?>
                <tr>
                  <td>{{$smile->user->name}}</td>
                  <td>{{number_format($smile->amount,2)}}
                  </td>
                  <td>{{$smile->created_at}}</td>

                 <td>
                   
                     @if($smile->user->is_pioneer==1)
                    <label class="label label-sm label-success">Pioneer</label>
                    @endif

                    @if($smile->user->is_pioneer==0)
                    <label class="label label-sm label-info">Participant</label>
                    @endif

                    @if($smile->user->is_teamlead==1 && $smile->user->is_pioneer==1)
                    <label class="label label-sm label-info">Pioneer | Team lead</label>
                    @endif

                     @if($smile->user->is_teamlead==1)
                    <label class="label label-sm label-info">Team lead</label>
                    @endif

                 </td>



                  <td> 


                  


				
                  @if(!isset($smile->rsmile->id))
                    <label class="label label-md {{$label}}">{{$status}}</label>
                    @else
                    <label class="label label-md label-default">Requested</label>
                    @endif

                    </td>
                    <td>
              <!-- action-->
              @if($status=='Available' && !isset($smile->rsmile->id))
              <a class="btn btn-success btn-sm" href="{{URL::to('admin/fasttrack/stage/'.$smile->id)}}">Stage smile</a>
              @endif


              @if($status=='Pending')
              <a class="btn btn-primary btn-sm hidden"  href="{{URL::to('admin/fasttrack/stage/'.$smile->id)}}" disabled='disabled'>Stage Smile</a>
              @endif

             
              
             

                  </td>
                  
                </tr>

                @endforeach





                </tbody>
                <tfoot>
                <tr>
                   <th>Giver's Name</th>
                  <th>Amount (Naira)</th>
                  <th>Date</th>
                  <!--<th>20% Conf. Date</th>-->
                  <th>Type</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table>


               {{$achievedSmiles->links()}}
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
