@extends('student.home')
@section('content')
<div class="container">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-4">
          <!--Section: Content-->
          @foreach($post as $post)
          <section>
            <!-- Post -->
            
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
                Khoá: {{$post->student->course->sokhoa}}
                </p>
                <p>
                Ngành: {{$post->student->major->name}}
                </p>
                @if($post->confirm!=null)
                <p>
                
                    <?php $confirm_post= App\Models\Confirm::where('post_id_confirm',$post->id)->with('student')->first();
                     
                    ?>
                    <a href="{{URL::to('student/profile/'.$confirm_post->student->id)}}">{{$confirm_post->student->name}} đã xác nhận </a>
                </p>
                @endif
                
                <form action="{{URL::to('student/confirm/'.$post->id)}}" method="POST">
                  @csrf
                  <input type="hidden" name="student_id" value="{{$post->student->id}}">
                  <button type="submit" class="btn btn-primary">Xác nhận</button>
                  <button  type="button" class="btn btn-primary"><a style="color:black;" href="{{URL::to('student/detail-post/'.$post->id)}}">Chi tiết</a></button>
                  <button  type="button" id="btn_report" class="btn btn-primary"><a style="color:black;" href="{{URL::to('student/report/'.$post->id)}}">Report</a></button>
                  
                  
                </form>

                
                      
              </div>
            </div>
            <!-- Post -->
          </section>
          @endforeach
          <!--Section: Content-->
        </div>
        <!--Grid column-->
    </div>
</div>
<script>

const btn = document.getElementById('btn_report');

btn.addEventListener('click', () => {
  const form = document.getElementById('form_report');

  if (form.style.display === 'none') {
    form.style.display = 'block';
  } else {
    form.style.display = 'none';
  }
});
  </script>
@endsection