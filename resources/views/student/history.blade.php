@extends('student.profile')
@section('extra-content')

@if(!is_null($confirm))
<ul class="list-group list-group-flush">
    @foreach($confirm as $confirm)
    <div class="alert alert-dark" >
    <strong> <a href="{{URL::to('student/profile/'.$confirm->student->id)}}" class="alert-link">{{$confirm->student->name}}</a></strong> đã xác nhận  <strong> <a href="{{URL::to('student/detail-post/'.$confirm->post_id_confirm)}}">bài viết <a></strong> của bạn .
  </div>
  @endforeach
</ul>

 
@else <li class="list-group-item"></li> 
@endif
@endsection