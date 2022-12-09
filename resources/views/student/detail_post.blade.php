@extends('student.home')
@section('content')

<div class="sticky-top" style="border-radius: 5px;background-color: wheat; width:900px ; margin:0px 0px 0px 200px">
                <div class="input-group mb-4" style="padding: 10px 0px 0px 250px">
                  <label for="exampleInputEmail1" style="color:#171717">Tiêu đề</label>
                  <input type="textarea" value="{{$post->title}}" style="margin : 0px 0px 0px 50px" class="col-4" name="title" id="title" aria-describedby="emailHelp" placeholder="Title">
                </div>
                <div class="input-group mb-4" style="padding: 0px 0px 0px 210px">
                  <label for="exampleInputEmail1" style="color:#171717">Người đăng</label>
                  <p style="padding: 0px 0px 0px 100px;"><a style="color:black;" href="{{URL::to('student/profile/'.$post->student->id)}}">{{$post->student->name}}</a></p>
                 
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 200px">
                  <label for="exampleInputEmail1" style="color:#171717">Thuộc danh mục</label>
                  <input type="text" value="{{$post->category->name}}" style="margin : 0px 100px 0px 30px" class="col-4"  name="category" >
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 300px">
                  <div class="custome-file">
                    <!-- <input type="file" class="form-control"  name="image[]"> -->
                    <img src="{{URL::to('images/'.$post->image)}}" style="height:150px; margin-left:60px;">
                  </div>
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 250px">
                <label for="exampleInputEmail1" style="color:#171717">Giá</label>
                  <input type="text" value="{{$post->price}}                                           VNĐ" style="margin : 0px 0px 0px 70px" class="col-4"  name="price" placeholder="VND">
                </div>
                </div>

    <form action="{{URL::to('student/post/'.$post->id.'/comment')}}" method="POST">
    {{ csrf_field() }}
    <div class="container justify-content-center mt-5 border-left border-right">
    <div class="modal-body">
          <div class="rating"> 
            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> 
            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
          </div>
        </div>
    <div class="d-flex justify-content-center pt-3 pb-2"> <input type="text" name="comment" placeholder="+ Thêm bình luận" class="form-control addtxt"> </div>
        <button type="submit" class="btn btn-primary">Bình luận</button>
    </form>

    @if($comment!=null)
    @foreach($comment as $comment)
    <div class="d-flex justify-content-center py-2">
                
        <div class="second py-2 px-2"> <span class="text1">{{$comment->content}}</span>
                <?php $rating=$comment->rating ?>
                @for($i=1;$i<=$rating;$i++)
                <span class="fa fa-star checked"></span>
                @endfor
                @for($j=$rating+1;$j<=5;$j++)
                <span class="fa fa-star"></span>
                @endfor
               
            <div class="d-flex justify-content-between py-1 pt-2">
                <div><img src="{{URL::to('images/'.$comment->student->image)}}" width="18"><span class="text2">{{$comment->student->name}}</span></div>
                @if(Session::get('student_id')!=$comment->student_id && Session::get('student_id')==$post->student_id)
                <div><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><a href="{{URL::to('student/detail-post/'.$post->id.'/reply-comment/'.$comment->id)}}">Reply</a></div>
                @endif
                @if(Session::get('student_id')==$comment->student->id)
                <div><span class="text3"><a href="{{URL::to('student/detail-post/'.$post->id.'/edit-comment/'.$comment->id)}}">Edit</a></span><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><a href="{{URL::to('student/detail-post/'.$post->id.'/delete-comment/'.$comment->id)}}">Xoá</a></div>
                @endif
          </div>
          @if($comment->replycomment!=null)
          @foreach($comment->replycomment as $replycomment)
            <div class="d-flex justify-content-center py-2">
              <div class="second py-2 px-2"> <span class="text1">Reply:{{$comment->student->name}}</span>
              <?php
                $student_reply=\App\Models\Student::where('id',$replycomment->student_id)->first();
              ?>
                  <div class="d-flex justify-content-between py-1 pt-2">
                     
                      <div><img src="{{URL::to('images/'.$replycomment->student->image)}}" width="18"><span class="text2">{{$student_reply->name}}</span></div>
                      @if(Session::get('student_id')!=$student_reply->id && Session::get('student_id')==$post->student_id)
                      <div><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><a href="{{URL::to('student/detail-post/'.$post->id.'/reply-comment/'.$replycomment->id)}}">Reply</a></div>
                      @endif
                      @if(Session::get('student_id')==$student_reply->id)
                      <div><span class="text3"><a href="{{URL::to('student/detail-post/'.$post->id.'/edit-replycomment/'.$replycomment->id)}}">Edit</a></span><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><a href="{{URL::to('student/detail-post/'.$post->id.'/delete-replycomment/'.$replycomment->id)}}">Xoá</a></div>
                      @endif
                      
                </div>
                <span class="text1">{{$replycomment->content}}</span>
              </div>
             
          </div>
          @endforeach
          @endif
        </div>
    </div>
  @endforeach
@endif
 
    
</div>



<style>
body{
	background-color: #fff;
}
.container{
	background-color: #eef2f5;
	width: 400px;
}
.addtxt{
	padding-top: 10px;
	padding-bottom: 10px;
	text-align: center;
	font-size: 13px;
	width: 350px;
	background-color: #e5e8ed;
	font-weight: 500;
}
.form-control: focus{
	color: #000;
}
.second{
	width: 350px;
	background-color: white;
	border-radius: 4px;
	box-shadow: 10px 10px 5px #aaaaaa;
}
.text1{
	font-size: 13px;
    font-weight: 500;
    color: #56575b;
}
.text2{
	font-size: 13px;
    font-weight: 500;
    margin-left: 6px;
    color: #56575b;
}
.text3{
	font-size: 13px;
    font-weight: 500;
    margin-right: 4px;
    color: #828386;
}
.text3o{
	color: #00a5f4;

}
.text4{
	font-size: 13px;
    font-weight: 500;
    color: #828386;
}
.text4i{
	color: #00a5f4;
}
.text4o{
	color: white;
}
.thumbup{
	font-size: 13px;
    font-weight: 500;
    margin-right: 5px;
}
.thumbupo{
	color: #17a2b8;
}
</style>

@endsection