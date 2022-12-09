@extends('student.home')
@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{URL::to('student/add-rating/'.$student->id)}}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rating {{$student->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="rating"> 
            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<section class="h-100 gradient-custom-2">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card">
          <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
            <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
              <img src="{{URL::to('images/'.$student->image)}}"
                alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                style="width: 150px; z-index: 1">
              @if($student->id==Session::get('student_id'))
              <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                style="z-index: 1;">
                <a href="{{URL::to('student/update-avatar/'.$student->id)}}"> Update Avatar</a>
                
              </button>
              @endif
            </div>
            <div class="ms-3" style="margin-top: 130px;">
                
              <h5>{{$student->name}}</h5>
              <!-- <p>Khoá:{{$student->course->sokhoa}}</p>
              <p>Ngành:{{$student->major->name}}</p> -->
              
            </div>
          </div>
          <div class="p-4 text-black" style="background-color: #f8f9fa;">
            <div class="d-flex justify-content-end text-center py-1">
           
              <div>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                 Rating
              </button>
              @if($student->id!=Session::get('student_id'))
                <?php
                  $follow=\App\Models\Follow::where('student_id',Session::get('student_id'))->where('student_id_follow',$student->id)->first();
                ?>
               
                @if($follow)
                <form action="{{URL::to('student/unfollow/'.$student->id)}}" method="post">
                @csrf
                  <button type="submit" class="btn btn-info">
                    UnFollow
                  </button>
                </form>
                @else
                <form action="{{URL::to('student/follow/'.$student->id)}}" method="post">
                @csrf
                  <button type="submit" class="btn btn-info">
                    Follow
                  </button>
                </form>
               @endif
             
              @endif
               

             
               
                <p class="mb-1 h5">{{$post->count()}}</p>
                <p class="small text-muted mb-0">Số bài viết</p>
                <?php
                  $blacklist= \App\Models\BlackList::where('student_id',Session::get('student_id'))->get();
                  if($blacklist!=null){
                    $quantity_post=$post->count();
                    $mark=($quantity_post/10)*2;
                  }
                  else {
                    $count=$blacklist->count;
                    $quantity_post=$post->count();
                    $mark=($quantity_post/10-$count/5)*2;
                  }
                
                ?>
                <p class="mb-1 h5">{{$mark}}</p>
                <p class="small text-muted mb-0">Tích điểm</p>
              </div>
              
              
            </div>
            <div class="rating">
                <span class="mb-1 h5">{{$rating->count()}} Rating</span>
               
                @for($j=$average+1;$j<=5;$j++)
                <span class="fa fa-star"></span>
                @endfor
                @for($i=1;$i<=$average;$i++)
                <span class="fa fa-star checked"></span>
                @endfor
              

              </div>
            
          </div>
          
          <div class="card-body p-4 text-black">
            <div class="mb-5">
              @if($student->id==Session::get('student_id'))
                <p class="lead fw-normal mb-1"><a href="{{URL::to('student/update-profile/'.$student->id)}}" >Cập nhật địa chỉ</a></p>
              @endif
              <div class="p-4" style="background-color: #f8f9fa;">
                <p class="font-italic mb-1">Khoá:{{$student->course->sokhoa}}</p>
                <p class="font-italic mb-1">Ngành:{{$student->major->name}}</p>
                <p class="font-italic mb-1">Khoa:{{$student->major->faculty->name}}</p>
                <p class="font-italic mb-1">SĐT:@if($student->phone!=null)   {{$student->phone}} @endif</p>
                <p class="font-italic mb-1">Địa chỉ hiện tại: Quận @if($student->district!=null) {{$student->district->name}} @endif, Phường @if($student->ward!=null) {{$student->ward->name}} @endif</p>
                
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="mb-0"><a href="{{URL::to('student/profile/'.$student->id)}}" class="text-muted">Recent post</a></p>
              @if($student->id==Session::get('student_id'))
              <p class="mb-0"><a href="{{URL::to('student/history/'.$student->id)}}" class="text-muted">Lịch sử thông báo</a></p>
              <p class="mb-0"><a href="{{URL::to('student/history-confirm/'.$student->id)}}" class="text-muted">Lịch sử xác nhận</a></p>
              <p class="mb-0"><a href="{{URL::to('student/list-follow/'.$student->id)}}" class="text-muted">Danh sách theo dõi</a></p>
              @endif
            </div>
            <div class="row g-2">
                @yield('extra-content')
            </div>
            <!-- <div class="row g-2">
              <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
              <div class="col">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp"
                  alt="image 1" class="w-100 rounded-3">
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>

  
  </style>
@endsection