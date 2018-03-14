@extends('layouts.admin_pages')

@section('content')








   <!-- Main content -->


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        LAUGHTER COMMUNITY
        <small>Dashboard&nbsp;|&nbsp;Inbox</small>
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
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    {{date('F d, Y', strtotime($message->updated_at))}}
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{date('h:i',strtotime($message->updated_at))}}</span>
                <hr><hr>
<div style="margin-left:15px; ">
  <h4>Sender's Name: {{$message->name}}</h4>
  <h4>Sender's Email: {{$message->email}}</h4>
  <h4>Message Type: <label class="label label-info">
   @if($message->type == 1)
  {{'Contact message'}}
  @elseif($message->type == 3)
  {{'Fake teller message'}}
  @elseif($message->type == 2)
  {{'Blockage message'}}
  @else
  {{null}}
  @endif
  </label>
  </h4>
</div>
                

                <h1 class="timeline-header"><a class="h3">Title: {{$message->title}}</a></h1>

                <div class="timeline-body h4" style="line-height: 40px;">
                <h3><b>Message : </b></h3>
                   {{$message->body}}
                   
                </div>

                <div style="margin-left: 15px;">
                  
                  @if($message->attachment != '0')
                    <a class="btn btn-primary" href="{{asset('/public/uploads/'.$message->attachment_link)}}" target="_blank">View attachment</a>
                @endif
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-danger btn-xs" href="{{URL::to('/admin/message/list')}}">Back</a>
                 
                </div>
              </div>
            </li>
            <!-- END timeline item -->
            </ul>
            <!-- timeline item -->
            

              
        <!-- /.col -->
      </div>
        
                <!-- /.col -->

        </section>























		@endsection
