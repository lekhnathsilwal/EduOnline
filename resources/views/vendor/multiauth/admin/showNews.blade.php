@extends('app')
@section('content')
<div class="container">
    <a href="/" class="btn btn-default">Go Back</a>
    <h1>{{$circleNews->heading}}</h1><br><hr>
    <img style="width:100; max-height:400px;" src="{{url('/storage/admin/circle_news/'.$circleNews->file)}}"><hr><br>
    <p>{{$circleNews->description}}</p>    
    <small>Updated on: {{$circleNews->updated_at}}</small>
</div>
@endsection