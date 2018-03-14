@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        My wallet
       
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
            
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              
              <div class="box">
            <div class="box-header">
            RL Wallet
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                 <th>ID</th>
                  <th>Total RL value</th>
                  <th>Amount Received</th>
                  <th>Amount Left</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>

              @foreach($rsmiles as $rsmile)
                 
                <tr class="<?php if($rsmile->left_amount==0){echo 'bg-green';} ?>">
                <td>#{{$rsmile->track_token}}</td>
                  <td>{{number_format($rsmile->amount,2)}}</td>
                  <td>
                  {{number_format(($rsmile->amount - $rsmile->left_amount),2)}}
                  </td>
                  <td>{{number_format($rsmile->left_amount,2)}}</td>

                  <td>
                    
                      @if($rsmile->left_amount==0)
                      <label class="label label-sm label-default"> Fully matched</label>
                      @elseif($rsmile->left_amount>0 && $rsmile->left_amount<$rsmile->amount)
                      <label class="label label-sm label-primary">Partially matched</label>
                      @else
                      <label class="label label-sm label-primary">Not yet matched</label>
                      
                      @endif
                  </td>
                  
                
                </tr>

                @endforeach


                
               
                </tbody>
                <tfoot>
                <tr>

                  <th>ID</th>
                  <th>Total RL value</th>
                  <th>Amount Received</th>
                  <th>Amount Left</th>
                  <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$rsmiles->links()}}
            </center>

            </div>

          </div>
          <!-- /.box -->

            </div>
          </div>


           <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              
              <div class="box">
            <div class="box-header">
            RL Retainment Wallet
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th>RL ID</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

              @foreach($retaiments as $retainment)
                 
                <tr>
                  <td>#{{$retainment->rsmile->track_token}}</td>
                  <td>{{number_format($retainment->amount,2)}}</td>
                  <td>
                    @if($retainment->status==0)
                    <label class="label label-sm label-available">{{'Available'}}</label>
                    @elseif($retainment->status==2)
                  <label class="label label-success label-sm">Cashed out</label>
                    @endif
                  </td>
                  <td>
      
                   <!-- Button trigger modal -->
                   @if($retainment->status==0)


<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal{{$retainment->id}}">
  Receive
</button>

<!-- Modal -->
<div class="modal fade" id="myModal{{$retainment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" style="overflow-x: auto;">
          
          You are to make new GL of 100% and above with insurance payment confirmed before you can cash out.

        </h4>
      </div>
      <div class="modal-body">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Make new GS</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{URL::to('/gsmile/create')}}" name="gsmile_form" role="form">
              <div class="box-body">

                
               {{ csrf_field() }}

               <div class="form-group">
                    
                    <!--<label for="inputSkills" class="col-sm-2 control-label">ID</label>-->

                    <div class="col-sm-10">
                    <p>
                      <input name="retainment_id"  type="hidden" class="form-control" id="inputSkills" placeholder="" value="{{$retainment->r_token}}">

                      <input name="retainment_amt"  type="hidden" class="form-control" id="inputSkills" placeholder="" value="{{$retainment->amount}}">

              
                      </p>
                    </div>
                  </div>


                    <div class="form-group">
                    
                    <label for="inputSkills" class="col-sm-2 control-label">Currency</label>

                    <div class="col-sm-10">
                    <p>
                      <input name="currency" disabled="disabled" type="text" class="form-control" id="inputSkills" placeholder="" value="Naira">
                      </p>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Amount</label>

                    <div class="col-sm-10">
                    <p>
                      <input name="amount" type="number" class="form-control" id="inputSkills" placeholder="Must be between 10000.00 to 500000.00(inclusive)" value="">
                      </p>
                    </div>
                   
                  </div>

                  
              
                  
               


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
               <button style="float: right; margin-right: 25px;" type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
      </div>

    </div>
  </div>
</div>



                   @elseif($retainment->status==2)
                   
                   {{null}}

                   @else


                   <form action="{{URL::to('/retainment/receive')}}" method="POST">
                                 {{ csrf_field() }}
                      <input type="hidden" name="retaiment_id" value="{{$retainment->r_token}}"> 

                      <input type="hidden" name="amount" value="{{$retainment->amount}}"> 
                      <input class="btn btn-success btn-sm" type="submit" name="submit" value="Receive">
                    </form>

                   @endif


                     
                  </td>
                  
                
                </tr>

                @endforeach


                     
                
               
                </tbody>
                <tfoot>
                <tr>

                  <th>RS ID</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
            <center style="margin:-15px;">
               {{$rsmiles->links()}}
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