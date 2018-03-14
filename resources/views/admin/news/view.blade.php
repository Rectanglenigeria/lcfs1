@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        SMILESTEADY
        <small>Dashboard&nbsp;|&nbsp;News</small>
      </h1>
         </section>


    
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- ################################################### changes made -->
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->

        <div class="col-md-12">
          <!-- The time line -->


@if(!empty($news))
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    {{date('F d, Y', strtotime($news->updated_at))}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{date('h:i',strtotime($news->updated_at))}}</span>

                <h1 class="timeline-header"><a class="h3">Title: {{$news->title}}</a></h1>

                <div class="timeline-body h4" style="line-height: 40px;">
                   {{$news->body}}
                   
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-danger btn-xs" href="{{URL::to('/admin/news/delete/'.$news->id)}}">Delete</a>
                 
                </div>

                <div class="timeline-footer">
                  <a class="btn btn-success btn-xs" href="{{URL::to('/admin/news/list')}}">Back</a>
                 
                </div>

                
              </div>
            </li>
            <!-- END timeline item -->
            </ul>
            <!-- timeline item -->
            @endif

              
        <!-- /.col -->
      </div>
        
                <!-- /.col -->

        </section>























		@endsection
