@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Thuộc bài viết với tiêu đề</th>
      <th scope="col">Thuộc Bình luận</th>
      <th scope="col">Người bình luận</th>
      
    </tr>
  </thead>

  <tbody>
@foreach($reply_comment as $reply_comment)
    <tr>
      <th scope="row">{{$reply_comment->post->title}}</th>
      <td>{{$reply_comment->comment->content}}</td>
      <td>{{$reply_comment->student->name}}</td>
      <td><form action="{{URL::to('delete-replycomment/'.$reply_comment->id)}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
        </form></td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection