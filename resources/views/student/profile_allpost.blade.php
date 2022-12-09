@extends('student.profile')

@section('extra-content')
@foreach($post as $post)
            @if(Session::get('student_id')==$post->student->id)
            
            <div class="row g-2">
            <p>Tiêu đề: {{$post->title}} </p>
              <p>Giá: {{$post->price}} </p>
              @foreach($confirm as $alert)
              @if($alert->post_id_confirm == $post->id)
              <p>Được xác nhận bởi: 
               
               
                <a href="{{URL::to('student/profile/'.$alert->student->id)}}"> {{$alert->student->name}}</a>
                </p>
                @endif
              @endforeach
              <div class="col mb-2">
                <img src="{{URL::to('images/'.$post->image)}}"
                  alt="image 1" class="w-100 rounded-3" style="height: 300px;">
              </div>
              
              <button type="button" class="btn btn-info"><a href="{{URL::to('student/detail-post/'.$post->id)}}" style="color:white;">Chi tiết</a></button>
              <button type="button" class="btn btn-info"><a href="{{URL::to('student/'.$student->id.'/edit-post/'.$post->id)}}" style="color:white;">Điều chỉnh</a></button>
              
              
            </div>
            
            @elseif(Session::get('student_id')!=$post->student->id )
                

                <div class="row g-2">
              <p>Tiêu đề: {{$post->title}} </p>
              <p>Giá: {{$post->price}} </p>
              @foreach($confirm as $alert)
              @if($alert->post_id_confirm == $post->id)
              <p>Được xác nhận bởi: 
                <a href="{{URL::to('student/profile/'.$alert->student->id)}}"> {{$alert->student->name}}</a>
                </p>
                @endif
              @endforeach
              <div class="col mb-2">
                <img src="{{URL::to('images/'.$post->image)}}"
                  alt="image 1" class="w-100 rounded-3" style="height: 300px;">
              </div>
              @if(Session::get('student_id')==$post->student->id)
              <button type="button" class="btn btn-info"><a href="{{URL::to('student/detail-post/'.$post->id)}}" style="color:white;">Chi tiết</a></button>
              <button type="button" class="btn btn-info"><a href="{{URL::to('student/'.$student->id.'/edit-post/'.$post->id)}}" style="color:white;">Điều chỉnh</a></button>

              @endif
              @if(Session::get('student_id')!=$post->student->id)
              <form action="{{URL::to('student/confirm/'.$post->id)}}" method="POST">
                  @csrf
                  <input type="hidden" name="student_id" value="{{$post->student->id}}">
                  <button type="submit" class="btn btn-primary">Xác nhận</button>
                </form>
              @endif
            </div>

                @endif
            
            

            
            @endforeach
@endsection