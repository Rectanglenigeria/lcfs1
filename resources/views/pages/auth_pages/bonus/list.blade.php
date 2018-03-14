@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bonuses
       
      </h1>
      
    </section>

    <section class="content">
      <!--refereer link-->
          
        <!--refereer link-->
     @if(Session::has('notification'))
          <p class="alert alert-success alert-sm alert-dismissable">{{Session::get('notification')}}</p>
        @endif

        

       <!-- <div class="callout callout-info">
            
                <center><a href="givesmiles.php"><button type="button" class="btn bg-olive btn-flat margin">Give Smiles</button></a>
              
                <a href="receivesmiles.php"><button type="button" class="btn bg-red btn-flat margin">Receive Smiles</button></a></center>
              
        </div>-->

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
              <li class="pull-left header"><i class="fa fa-inbox"></i> Referrer</li>
              &nbsp;<span class="badge">{{$totalRefBonus}}</span>
            </ul>


            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              


               <table class="table table-hover">
                <tbody>

                <tr>
                   <th>Referree's name</th>
                  <!--<th>GS amount</th>-->
                  <th>Bonus (Naira)</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>


                @foreach($refererBonuses as $bonus)

                <?php
                    if(!isset($bonus->referee->name)){
                      continue;
                    }
                ?>
                <tr>
                  <td>{{$bonus->referee->name}}</td>
                  <!--<td>
                  </td>-->
                  <td>{{number_format($bonus->amount,2)}}</td>

                  <td> 
                  {{$bonus->created_at}}
        
                </td>


                <td>
              <!-- action-->

              @if($bonus->has_cashed_out ==1 )
              <label class="label label-success label-sm">Cashed out</label>
              {{null}}

              @else($bonus->has_cashed_out ==0)
              <a href="{{URL::to('bonus/referer/receive/'.$bonus->id)}}" class="btn btn-primary btn-sm" role="button">Receive</a>
              @endif
             

                  </td>
                  
                </tr>

                @endforeach




              </tbody></table>

              {{$refererBonuses->links()}}





            </div>

            </div>







          </div>


             <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Video</li>
            </ul>


            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              

<table class="table table-hover">
                <tbody>

                <tr>
                   <th>RL Amount (Naira)</th>
                  <th>Bonus (5% of RS)</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>


                @foreach($videoBonuses as $bonus)

                <tr>
                  <td>{{number_format($bonus->rsmile->amount,2)}}</td>
                  <td>{{number_format($bonus->amount,2)}}
                  </td>
                  <td>{{$bonus->created_at}}</td>

                  <td> 

                <td>
              <!-- action-->
              @if($bonus->has_cashed_out ==1 )
              {{null}}

              @else($bonus->has_cashed_out ==0)
              <a href="{{URL::to('bonus/video/receive/'.$bonus->id)}}" class="btn btn-primary btn-sm" role="button">Reap</a>
              @endif
             
             

                  </td>
                  
                </tr>

                @endforeach




              </tbody></table>

              {{$videoBonuses->links()}}




            </div>

            </div>







          </div>

        </section>







                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()