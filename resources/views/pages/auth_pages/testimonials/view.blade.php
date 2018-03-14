@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Testimonials / View
       
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

        <div class="col-md-12">
          <!-- The time line -->
          <div class="row">

          

            <div class="col-md-12">
            <div class="thumbnail">
          @if($testimony->has_video != null && $testimony->has_video != '0')

            


<?php

     $rawLink=$testimony->video_link;
     $explodedLink=explode('watch?v=', $rawLink);
     $implodedLink=implode('embed/', $explodedLink);
?>
   

          <iframe style="width:100%; height: 450px;" src="{{$implodedLink}}" frameborder="0" allowfullscreen></iframe>

           
       <!--<video controls poster="" width="350">
          <source src="{{$testimony->video_link}}" type="video/mp4">
            Your browser does not support HTML5 video.
    </video>-->
        @else

        <img src="{{asset('public/videos/placeholderImage.png')}}" style="width:100%;height: 450px">

        @endif


      <div class="caption">
        <span style="float:left;">
          {{date('F d, Y', strtotime($testimony->updated_at))}}&nbsp;|&nbsp;
          {{date('h:i',strtotime($testimony->updated_at))}}
        </span>
        <hr>
        <h3>{{$testimony->user->name}}</h3>
        <p style="line-height: 40px;">{{$testimony->message}}</p>
        <p><a href="{{URL::to('/testimonials/list')}}" class="btn btn-danger btn-sm" role="button">back</a> </p>
      </div>
    </div>
    </div>

    

            </div>
            <!-- timeline item -->
           
            
              
        <!-- /.col -->
           
      </div>
        
                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()