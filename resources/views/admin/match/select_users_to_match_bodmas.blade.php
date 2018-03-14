@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY1
        <small>Dashboard&nbsp;|&nbsp; Select Smiles</small>
      </h1>
         </section>

         <div class="alert alert-info alert-sm alert-dismissable">
            <span>Quick Tutorial: </span>
            <ol>
            <li>
               Select GS request or group of GS requests to be matched with selected RS.
               
            </li>

            <li>
               This is an attempt to completely or partially match 90% of GS request(s).
            </li>

            <li>
              The matching is real-time.
            </li>

            </ol>
            
           
          </div>


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
              <li class="pull-left header"><i class="fa fa-inbox"></i> All Umatched GS Requests
              &nbsp;<!--<span class="badge">{{$UmatchedSmilesNo}}</span>--></li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
             


<div class="box">
            <div class="box-header">
               <p class="h3" style="float: left;">
       <span>Receiver's Name : {{ucwords($RsName)}}&nbsp;|&nbsp;</span>
       <span class="RsAmount" id="RsAmount">Amount Left: {{number_format($RsAmount,2)}}</span><span>&nbsp;Naira</span>
      </p>
            </div>
            <!-- /.box-header -->

            <form method="POST" action="{{URL::to('/admin/matches/create')}}" name="gsmile_form" role="form">

            <div class="box-body table-responsive no-padding">

            
            {{ csrf_field() }}
            <input type="hidden" name="RsId" value="{{$RsId}}">
                 <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <tbody>

                <tr>
                   <th>Giver's Name</th>
                   <th>GS Value (Naira)</th>
                   <th>Matched Amount (Naira)</th>
                  <th>Left Amount (Naira)</th>
                  <th>Request Age (Days)</th>
                  <th>Select</th>
                </tr>


                @foreach($UmatchedSmiles as $smile)

              <?php

              if($smile->user->is_block == 1){
                continue;
              }

              if($smile->user->id==37 || $smile->user->id==40){
                continue;
              }

              if($smile->left_amount==0){
                continue;
              }

              $ageInMilliSecs=intval(time())-intval(strtotime($smile->created_at));
              $ageInDays=floor($ageInMilliSecs/(60*60*24));
              

              
              ?>


                <tr>
                  <td>{{$smile->user->name}}</td>
                  <td>{{number_format($smile->amount,2)}}</td>
                  <td>{{number_format(($smile->amount-$smile->left_amount),2)}}</td>
                  <td>
                  <input type="hidden" name="amount{{$smile->id}}" id="amount{{$smile->id}}" value="{{$smile->left_amount}}">
                  {{number_format($smile->left_amount,2)}}
                  <!--{{number_format($smile->left_amount,2)}}&nbsp;from&nbsp;
                  {{number_format($smile->amount,2)}}-->
                  </td>
                  <td>
                  {{$ageInDays}}
                  </td>

                  <td> 

                   <input name="{{$smile->id}}" type="checkbox" class="" id="{{$smile->id}}"" onclick="updateRsAmount(this.id)">
                </td>
                
                  
                </tr>

                @endforeach

                <script type="text/javascript">
                var initRsAmount=parseFloat("{{$RsAmount}}");
                function updateRsAmount(smile_id)
                {
                 
                    var toBeSubtracted=parseFloat(document.getElementById("amount"+smile_id).value);
                initRsAmount=initRsAmount - toBeSubtracted;
                  document.getElementById('RsAmount').innerHTML=initRsAmount;
                 

                }

                </script>



              </tbody>


              </table>

             {{$UmatchedSmiles->links()}}
              </div>


             
            </div>
<center>
   <button class="btn btn-primary btn-lg" type="submit" name="submit">Submit</button>
</center>

            


            </form>
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
