@extends('student.home')
@section('content')

<div class="sticky-top" style="border-radius: 5px;background-color: #FAEBD7; width:900px ; margin:40px 0px 0px 200px">
                <div class="input-group mb-4" style="padding: 10px 0px 0px 300px">
                  <label for="username" >Người xác nhận</label>
                  <p></p>
                  <p style="margin: 0 0 0 20px ">  <a href="{{URL::to('student/profile/'.$confirmed->student->id)}}">          {{$confirmed->student->name}}</a></p>
                </div>

                <div class="input-group mb-4" style="padding: 10px 0px 0px 300px">
                  <label for="exampleInputEmail1" >Title</label>
                  <input type="textarea" value="{{$post->title}}" style="margin : 0px 0px 0px 50px" class="col-4" name="title" id="title" aria-describedby="emailHelp" placeholder="Title">
                </div>
                <div class="input-group mb-3" style="padding: 10px 0px 0px 220px">
                  <label for="exampleInputEmail1" style="margin: 10px 10px 10px 80px ">Category</label>
                  <input type="text" value ="{{$post->category->name}}">
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 300px">
                  <div class="custome-file">
                    <!-- <input type="file" class="form-control"  name="image[]"> -->
                    <img src="{{URL::to('images/'.$post->image)}}" style="height:150px; margin-left:70px;">
                  </div>
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 300px">
                <label for="exampleInputEmail1">Price</label>
                  <input type="text" value="{{$post->price}}" style="margin : 0px 0px 0px 50px" class="col-4"  name="price" placeholder="VND">
                </div>
                </div>


    
        </div>
    </div>

 
    
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