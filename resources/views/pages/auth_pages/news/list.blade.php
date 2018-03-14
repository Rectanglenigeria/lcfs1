@extends('layouts.auth_pages')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        NEWS
       
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
                   @if(strlen($news->body)<=250)
                   {{'.'}}
                   @else
                   {{'...'}}
                   @endif
                </div>
                <div class="timeline-footer">
                @if(strlen($news->body)<=250)
                   {{null}}
                   @else
                  <a class="btn btn-primary btn-xs" href="{{URL::to('/news/view/'.$news->id)}}">Read more</a>
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
        
                <!-- /.col -->

        </section>
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection()