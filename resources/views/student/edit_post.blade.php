@extends('student.home')
@section('content')

<div class="sticky-top" style="border-radius: 5px;background-color: #FAEBD7; width:900px ; margin:0px 0px 0px 200px">
            <form action="{{URL::to('student/'.$post->student->id.'/update-post/'.$post->id)}}" enctype="multipart/form-data" method="POST" > 
                {{ csrf_field() }}
                <div class="input-group mb-4" style="padding: 10px 0px 0px 300px">
                  <label for="exampleInputEmail1" >Title</label>
                  <input type="textarea" value="{{$post->title}}" style="margin : 0px 0px 0px 50px" class="col-4" name="title" id="title" aria-describedby="emailHelp" placeholder="Title">
                </div>
                <div class="input-group mb-3" style="padding: 10px 0px 0px 300px">
                  <label for="exampleInputEmail1">Category</label>
                  <select  style="margin : 0px 0px 0px 20px" name="category_id"  class="col-4" aria-label="Default select example">
                    @foreach($category as $key)
                      <option {{$key->id==$post->category->id ? 'selected' : ''}}  value ="{{$key->id}}">{{$key->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 300px">
                  <div class="custome-file">
                    <input type="file" class="form-control"  name="image[]">
                    <img src="{{URL::to('images/'.$post->image)}}" style="height:150px; margin-left:70px;">
                  </div>
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 300px">
                <label for="exampleInputEmail1">Price</label>
                  <input type="text" value="{{$post->price}}" style="margin : 0px 0px 0px 50px" class="col-4"  name="price" placeholder="VND">
                </div>
                <div class="input-group mb-3" style="padding: 10px 0px 0px 300px">
                  <label for="exampleInputEmail1">Trạng thái</label>
                  <select  style="margin : 0px 0px 0px 20px" name="status"  class="col-4" aria-label="Default select example">
                  <option {{$post->status==0 ? 'selected' : ''}} value="0">
                    Ẩn
                </option>
                <option {{$post->status==1 ? 'selected' : ''}} value="1">
                    Hiện
                </option>   
                  </select>
                </div>
                <div class="input-group mb-3" style="padding: 0px 0px 0px 440px">
                    <button type="submit"  class="btn btn-primary">Update</button>
                </div>
                
            </form>
          </div>

@endsection