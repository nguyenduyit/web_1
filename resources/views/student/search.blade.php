@extends('student.home')
@section('content')
<div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-4">
          <!--Section: Content-->
          <section>
            <!-- Post -->
            @if(!is_null($student))
            @foreach($student as $student)
            @if($student->id!= Session::get('student_id'))
            <?php
              $result=\App\Models\Student::where('id',$student->id)->with('major')->with('faculty')->with('course')->first();
            ?>
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="bg-image hover-overlay shadow-1-strong rounded ripple" data-mdb-ripple-color="light">
                  <img src="{{URL::to('images/'.$student->image)}}" class="img-fluid" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
              </div>

              <div class="col-md-8 mb-4">
                <h5></h5>
                <p>
                 <a href= "{{URL::to('student/profile/'.$student->id)}}">{{$student->name}}</a>
                </p>
                <p>
                Khoá:: {{$result->course->sokhoa}}
                </p>
                <p>
                Ngành:: {{$result->major->name}}
                </p>
                <p>
                Ngành:: {{$result->faculty->name}}
                </p>
                <?php
                  $follow=\App\Models\Follow::where('student_id',Session::get('student_id'))->where('student_id_follow',$student->id)->first();
                ?>
                @if(!$follow)
                <form action="{{URL::to('student/follow/'.$student->id)}}" method="POST">
                  @csrf
                
                  <button type="submit" class="btn btn-primary">Theo dõi</button>
                </form>
                @endif
               

               
                
              </div>
             
            </div>

            <!-- Post -->
           
            @endif
            @endforeach
            @endif
            <p></p>
            @if(!is_null($post))
            @foreach($post as $post)
            <div class="row">
              <div class="col-md-4 mb-4">
                <div class="bg-image hover-overlay shadow-1-strong rounded ripple" data-mdb-ripple-color="light">
                  <img src="{{URL::to('images/'.$post->image)}}" class="img-fluid" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                  </a>
                </div>
              </div>

              <div class="col-md-8 mb-4">
                <h5>{{$post->title}}</h5>
                <p>
                 <a href= "{{URL::to('student/profile/'.$post->student->id)}}">{{$post->student->name}}</a>
                </p>
                <p>
                Khoá:: {{$post->student->course->sokhoa}}
                </p>
                <p>
                Ngành:: {{$post->student->major->name}}
                </p>
                <form action="{{URL::to('student/confirm/'.$post->id)}}" method="POST">
                  @csrf
                  <input type="hidden" name="student_id" value="{{$post->student->id}}">
                  <button type="submit" class="btn btn-primary">Xác nhận</button>
                </form>
               

                <button style="width:109px; position:absolute; top:227px; right:670px;" type="button" class="btn btn-primary"><a style="color:black;" href="{{URL::to('student/detail-post/'.$post->id)}}">Chi tiết</a></button>
                
              </div>
             
            </div>

            <!-- Post -->
           

            @endforeach
            @endif
          </section>
          <!--Section: Content-->
        </div>
        <!--Grid column-->

@endsection