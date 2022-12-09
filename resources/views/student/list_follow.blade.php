@extends('student.profile')
@section('extra-content')

@foreach($list_follow as $key)
<div class="card" style="width: 18rem;">
  <img src="{{URL::to('images/'.$key->student_follow->image)}}" class="card-img-top" alt="...">
  <div class="card-body">
  
    <a href="{{URL::to('student/profile/'.$key->student_follow->id)}}" class="btn btn-primary">{{$key->student_follow->name}}</a>
  </div>
</div>
@endforeach

@endsection