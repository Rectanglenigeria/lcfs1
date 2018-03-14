@extends('layouts.admin_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Details
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
              <h3 class="box-title">details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-book margin-r-5"></i>Amount</strong>

              <p class="text-muted">
               {{$smile->amount}}
              </p>

              <hr>

              <strong><i class="fa fa-book margin-r-5"></i>Reaper's Name</strong>

              <p class="text-muted">
               {{$smile->user->name}}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Reaper's Phone</strong>

              <p class="text-muted">{{$smile->user->phone}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Reaper's Account Name</strong>

              <p class="text-muted">{{$smile->user->account_name}}</p>

              <hr>


              <strong><i class="fa fa-map-marker margin-r-5"></i>Reaper's Account Number</strong>

              <p class="text-muted">{{$smile->user->account_no}}</p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i>Reaper's Bank</strong>

              <p class="text-muted">{{ucwords($smile->user->bank)}}&nbsp; Bank</p>

            
              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Status</strong>

              <p>

                @if($smile->left_amount == 0)
                  <label class="label label-default lable-lg">Fully matched</label>
                  @elseif($smile->left_amount > 0 && $smile->left_amount < $smile->amount)
                  <label class="label label-default lable-lg">Partially matched</label>
                  @elseif($smile->left_amount == $smile->amount )
                  <label class="label label-default lable-lg">Not matched</label>
                  @endif

            
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Actions</strong>

              <p>
              @if($smile->left_amount > 0)
              <a class="btn btn-success btn-sm" href="{{URL::to('admin/matches/select_gs_users/'.$smile->id)}}">Match</a>
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