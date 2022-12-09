@extends('student.home')
@section('content')

<form action="{{URL::to('student/post/'.$post->id.'/reply-comment/'.$comment->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="container justify-content-center mt-5 border-left border-right">
    <div class="d-flex justify-content-center pt-3 pb-2"> <input type="text" name="replyComment" placeholder="+ Add your reply comment" class="form-control addtxt"> </div>
        <button type="submit" class="btn btn-primary">Đăng</button>
    </form>


@endsection