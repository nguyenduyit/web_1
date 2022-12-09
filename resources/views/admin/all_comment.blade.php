@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tiêu đề bài viết</th>
      <th scope="col">Bình luận</th>
      <th scope="col">Người bình luận</th>
      
    </tr>
  </thead>

  <tbody>

@foreach($comment as $comment)
@if($comment->post!=null)
    <tr>
      <th scope="row">{{$comment->post->title}}</th>
      <td>{{$comment->content}}</td>
      <td>{{$comment->student->name}}</td>
      <td><form action="{{URL::to('delete-comment/'.$comment->id)}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
        </form></td>
    </tr>
@endif
@endforeach
  </tbody>
</table>
@endsection