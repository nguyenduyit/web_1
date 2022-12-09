@extends('student.home')
@section('content')



<form action="{{URL::to('student/detail-post/'.$post->id.'/update-replycomment/'.$replycomment->id)}}" method="POST">
    {{ csrf_field() }}
    <div class="container justify-content-center mt-5 border-left border-right">
    <div class="d-flex justify-content-center pt-3 pb-2"> <input type="text" value="{{$replycomment->content}}" name="comment" placeholder="+ Add your comment" class="form-control addtxt"> </div>
        <button type="submit" class="btn btn-primary">Update ReplyComment</button>
    </form>
@endsection