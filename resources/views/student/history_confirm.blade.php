@extends('student.profile')
@section('extra-content')

@if(!is_null($history))
<ul class="list-group list-group-flush">
    @foreach($history as $history)
    <div class="alert alert-dark" >
    Bạn  đã xác nhận  <strong> <a href="{{URL::to('student/detail-post/'.$history->post_id_confirm)}}">bài viết <a></strong> của <strong> <a href="{{URL::to('student/profile/'.$history->owner_post->id)}}" class="alert-link">{{$history->owner_post->name}}</a></strong>.
    <form action="{{URL::to('student/cancelconfirm/'.$history->post_id_confirm)}}" method="POST">
      @csrf
      <input type="hidden" name="id_profile" value="{{$history->student_id_confirm}}">
      <button class="btn btn-danger" type="submit">Huỷ</button>
    </form>
  </div>
  
  @endforeach
</ul>

 
@else <li class="list-group-item"></li> 
@endif
@endsection