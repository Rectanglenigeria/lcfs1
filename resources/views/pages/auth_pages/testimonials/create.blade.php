@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Testimonials / Create
       
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
        <div class="" style="text-align:right;">
          <a class="btn btn-lg btn-success" href="{{URL::to('/testimonials/list')}}">View testimonies</a>

        </div>
        <br>
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Testimonial</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="box-body">
              <dl class="dl-horizontal">


              <form name="testimony_form" role="form"  action="{{URL::to('/testimonials/create')}}" method="POST">

                {{ csrf_field() }}

               
                  <div class="form-group{{ $errors->has('smileId') ? ' has-error' : '' }}">
                    <label for="inputSkills" class="control-label">Select Investment</label>

                    <div>
<?php
 $rsmileIdArray=[]; 
?>

                  <select class="form-control" name="smileId">

                  <option  disabled="disabled" selected="selected">Select Investment</option>
                
          <?php 
          foreach($achievedTestimonies as $key => $achieved){
            $rsmileIdArray[$key]=$achieved->rsmile_id;
          }
            ?>
         
                      
           @foreach($smiles as $smile)
           
              @if(in_array($smile->id, $rsmileIdArray))
               <?php
                continue;
               ?>
              @else
            <option value="{{$smile->id}}">
            Amount: {{number_format($smile->amount, 2)}} Naira on {{date('F d, Y', strtotime($smile->updated_at))}}
            </option>
            @endif
            @endforeach

        </select>

        @if ($errors->has('smileId'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('smileId') }}</strong>
                                    </span>
                                @endif
                      


                    </div>
                  </div>



                  <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                  <label for="inputMessage" class="col-sm-2 control-label">Message</label>
                  
                  <textarea id="inputMessage" name="message" class="form-control" rows="5" placeholder="Enter ...">{{old('message')}}
                  </textarea>
                 
                      @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                </div>



               

                
                  <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Testimonial Video</h3>

                      <div class="box-tools pull-right">
                      <button type="button" class="btn btn-sm btn-success" data-widget="collapse">add video link
                    </button>

                  </div>
                <!-- /.box-tools -->
                </div>
            <!-- /.box-header -->
                <div class="box-body">
                  
                 <div class="form-group">
                  <label>Video (upload your video to your youtube channel, copy and paste its link below.)</label>
                  <input id="video_link" name="video_link" type="text" class="form-control" placeholder="Youtube link" value="{{old('video_link')}}">
                </div>
                </div>
                </div>
              
              
              <button name="submit" type="submit" class="btn btn-danger btn-lg">Submit</button>
                </form>





              </dl>
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