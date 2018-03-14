@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Achieved Sowed Laughters

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
              <li class="pull-left header"><i class="fa fa-inbox"></i> Achieved Laughter(s)</li>
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
                  <th>Invested capital</th>
                  <th>R O I</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

              @foreach($achievedSmiles as $achieved)
                 <?php if($achieved->hidden ==1){
                  continue;
                 }
                 ?>
                <tr>
                  <td>{{number_format($achieved->amount,2)}}</td>
                  <td>
                  {{number_format($achieved->growth,2)}}
                  </td>
                  <td>{{number_format(($achieved->amount + $achieved->growth),2)}}</td>
                  <td> {{$achieved->created_at}}</td>
                  <td>


                      <?php
                      $sumAllMatchesAmount=0;
                      $paymentStatusArray=[];
                      $count=0;
                      foreach($achieved->confirmation as $confirmation){
                        $sumAllMatchesAmount= $sumAllMatchesAmount + $confirmation->amount;
                        $paymentStatusArray[$count]=$confirmation->payment_status;
                        $count++;
                      }

                      if(in_array(0, $paymentStatusArray) || in_array(1, $paymentStatusArray) || in_array(2, $paymentStatusArray)){
                        $paidAll=false;
                      }else{
                        //all are 3s
                        $paidAll=true;
                      }

                      if($achieved->amount == $sumAllMatchesAmount && $paidAll == true){
                        $status='Available';
                        $label='label-success';
                      }else{
                        $status="Pending";
                        $label='label-danger';
                      }

                     ?>

                     @if(!isset($achieved->rsmile->id))
                    <label class="label label-md {{$label}}">{{$status}}</label>
                    @else
                    <label class="label label-md label-default">Requested</label>
                    @endif

                  </td>
                  <td>
                  @if(!isset($achieved->rsmile->id))
                  @if($status=="Available")
                  <!--  <form action="{{URL::to('/rsmile/create')}}" method="POST">
                      <input type="hidden" name="smileId" value="">
                      <input type="hidden" name="totalAmount" value="">
                      <input class="btn btn-primary btn-md" type="submit" name="submit" value="Receive smile">
                    </form>-->
                  @endif
                  @endif
                  </td>
                </tr>

                @endforeach




                </tbody>
                <tfoot>
                <tr>
                  <th>Invested capital</th>
                  <th>R O I</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$achievedSmiles->links()}}
            </center>

            </div>

          </div>
          <!-- /.box -->

            </div>
          </div>
        </section>
        <!-- right col -->





                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()
