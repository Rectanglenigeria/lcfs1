@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;Testimonies</small>
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
 
      <div class="row">
      
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

  
        
         

<div class="row">
            <div class="col-md-6">

            
            <div class="thumbnail">
         @if($testimony->has_video != null && $testimony->has_video != '0')

           <iframe width="500" height="315" src="https://www.youtube.com/embed/DV-q5bwofz8" frameborder="0" allowfullscreen></iframe>

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

        <p>


        @if($testimony->has_approved == 1 || $testimony->has_approved == 2)
          {{'Approved'}}
        @else
        <a href="{{URL::to('admin/testimony/approve/'.$testimony->id)}}" class="btn btn-primary btn-sm" role="button">Approve</a> 
        @endif

         @if($testimony->has_approved == 2)
          {{'| Approved video, granted 5%'}}

          @else
         <a href="{{URL::to('admin/testimony/video/approve/'.$testimony->id)}}" class="btn btn-primary btn-sm" role="button">Approve video (5% bonus)
         </a>
         @endif

        </p>


      </div>
    </div>
    </div>
    </div>




        
          <!-- /.box -->


              
         
        </section>







        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
























		@endsection
