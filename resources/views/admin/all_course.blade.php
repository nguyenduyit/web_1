@extends('admin.adminHome')
@section('admin_content')

@if (session('status'))
  <h6 class="alert alert-success">{{ session('status') }}</h6>
@endif
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Khoá</th>
      
    </tr>
  </thead>

  <tbody>
@foreach($course as $key)
    <tr>
      <th scope="row">{{$key->id}}</th>
      <td>{{$key->sokhoa}}</td>
      <td><form action="{{route('course.destroy', $key->id )}}", method="POST">
            @csrf
            @method('delete')
            <button onClick="confirm('Delete?')" class="btn btn-block btn-success" type="submit">Xoá</button>
        </form></td>
    </tr>
@endforeach
  </tbody>
</table>
@endsection