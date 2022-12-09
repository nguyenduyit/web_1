@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif


<form action="{{URL::to('post/search-time')}}" method="POST">
  @csrf
<input type="month" id="start" name="start"
       min="2018-01" value="2022-11">
<button type="submit" class="btn btn-primary">Submit</button>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Tiêu đề</th>
      <th scope="col">Ảnh</th>
      <th scope="col">Giá</th>
      <th scope="col">Người đăng</th>
      <th scope="col">Thuộc danh mục</th>
      <!-- <th scope="col">Status</th> -->
      <th scope="col">Hành động</th>
      <th scope="col">Số lượt bị báo cáo</th>
    </tr>
  </thead>

  <tbody>
@if($post!=null)
@foreach($post as $key)

    <tr>
      <th scope="row">{{$key->title}}</th>
      <td><img src="{{URL::to('images/'.$key->image)}}" style="height: 100px; width: 150px;"></td>
      <td>{{$key->price}}</td>
      <td>{{$key->student->name}}</td>
      <td>{{$key->category->name}}</td>
      
      <!-- <td>

      <form action="{{route('post.update', $key->id )}}", method="POST">
            @csrf
            @method('put')
            <select class="form-select" name="status" aria-label="Default select example">
                <option {{$key->status==0 ? 'selected' : ''}} value="0">
                    Ẩn
                </option>
                <option {{$key->status==1 ? 'selected' : ''}} value="1">
                    Hiện
                </option>   
            </select>
            <button  class="btn btn-block btn-success" type="submit">Cập nhật</button> 
        </form>
        
      </td> -->
      <td>
        <form action="{{route('post.destroy', $key->id )}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
        </form>
       
      </td>
      <td>
        {{$key->report->count()}}
       
      </td>
      <td>
      <button type="button" class="btn btn-block btn-success"><a href="{{URL::to('post/'.$key->id.'/list')}}">Danh sách người báo cáo</a></button>
      </td>
        
    </tr>
@endforeach
@endif
  </tbody>
</table>
<style>

label {
    display: block;
    font: 1rem 'Fira Sans', sans-serif;
}

input,
label {
    margin: .4rem 0;
}
  </style>
@endsection