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

  
        
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
           
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><span><i class="fa fa-inbox"></i> All achieved news</span></li>
            </ul>
           
          </div>

           
<div>
   <a href="{{URL::to('/admin/news/create')}}" class="btn btn btn-success">Create news</a>
</div>
<br>

           <div>

 

          <!-- The time line -->
          <ul class="timeline">

          @foreach($newsfeeds as $news)

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
                   {{substr($news->body, 0, 250)}}
                   @if(strlen($news->body)==250)
                   {{'.'}}
                   @else
                   {{'...'}}
                   @endif
                </div>
                <div class="timeline-footer">
                @if(strlen($news->body)==250)
                   {{null}}
                   @else
                  <a class="btn btn-primary btn-xs" href="{{URL::to('admin/news/view/'.$news->id)}}">Read more</a>
                  @endif
                </div>
              </div>
            </li>
            <!-- END timeline item -->

            @endforeach




            </ul>
            <!-- timeline item -->
            <center>
              {{ $newsfeeds->links() }}
            </center>
            
              
        <!-- /.col -->
           
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
