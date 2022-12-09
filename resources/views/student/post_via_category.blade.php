@extends('student.home')
@section('content')
<div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-4">
          <!--Section: Content-->
          @if($post!=null)
          @foreach($post as $key)
          <section>
            <!-- Post -->
            
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="bg-image hover-overlay shadow-1-strong rounded ripple" data-mdb-ripple-color="light">
                  <img src="{{URL::to('images/'.$key->image)}}" class="img-fluid" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
              </div>
             

              <div class="col-md-8 mb-4">
                <h5>{{$key->title}}</h5>
                <p>
                 <a href= "{{URL::to('student/profile/'.$key->student->id)}}">{{$key->student->name}}</a>
                </p>
                <?php

                  $student=\App\Models\Student::where('id',$key->student_id)->with('major')->with('course')->first();
                ?>
                <p>
                Khoá: {{$student->course->sokhoa}}
                </p>
                <p>
                Ngành: {{$student->major->name}}
                </p>
               
                <p>
                    <?php $confirm_post= App\Models\Confirm::where('post_id_confirm',$key->id)->with('student')->first();
                     
                     ?>
                     
                     @if($confirm_post!=null)
                     
                     <a href="{{URL::to('student/profile/'.$confirm_post->student->id)}}">{{$confirm_post->student->name}} đã xác nhận </a>
                     @endif
                
                    
                </p>
               
                
                <form action="{{URL::to('student/confirm/'.$key->id)}}" method="POST">
                  @csrf
                  <input type="hidden" name="student_id" value="{{$key->student_id}}">
                  <button type="submit" class="btn btn-primary">Xác nhận</button>
                  <button  type="button" class="btn btn-primary"><a style="color:black;" href="{{URL::to('student/detail-post/'.$key->id)}}">Chi tiết</a></button>
                  <button  type="button" id="btn_report" class="btn btn-primary"><a style="color:black;" href="{{URL::to('student/report/'.$key->id)}}">Report</a></button>
                  
                  
                </form>

                
                      
              </div>
            </div>
            <!-- Post -->
          </section>
         
          @endforeach
          @endif
          <!--Section: Content-->
        </div>
        <!--Grid column-->
    </div>
</div>

@endsection