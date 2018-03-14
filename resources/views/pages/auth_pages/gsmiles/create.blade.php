@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Sow Laughter
       
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
      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
<div class="" style="text-align:right;">
         

        </div>

  <section class="col-lg-3"></section>
        <section class="col-lg-6 connectedSortable">
        
        <br>


<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sow Laughter</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{URL::to('/gsmile/create')}}" name="gsmile_form" role="form">
              <div class="box-body">


               {{ csrf_field() }}
                    <!--<div class="form-group">
                    
                    <<label for="inputSkills" class="col-sm-2 control-label">Currency</label>

                    <div class="col-sm-10">
                    <p>
                      
                      </p>
                    </div>
                  </div>-->


                  <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    <label for="inputSkills" class="col-sm-2 control-label">Amount(N)</label>

                    <div class="col-sm-10">
                    <p>

                      <input name="currency" disabled="disabled" type="hidden" class="form-control" id="inputSkills" placeholder="" value="Naira">
                      <input name="amount" type="number" class="form-control" id="inputSkills" placeholder="Must be between 5,000.00 to 200,000.00(inclusive)" value="{{old('amount')}}">

                      @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                      </p>
                    </div>
                   
                  </div>

                  
              
                  
               


              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <center>

                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <a class="btn btn-sm btn-success" href="{{URL::to('/gsmile/achieved')}}">View Laughters</a>
                  
                </center>
                                
              </div>
            </form>
          </div>


        </section>

          <section class="col-lg-3"></section>







                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()