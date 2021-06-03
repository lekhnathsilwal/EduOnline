@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Your Posts</h3></div><hr><br>
                    <div class="panel-body">
                        @if(count($posts) > 0)
                            <table class="table table-striped">
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th></th>
                                </tr>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->post_body}}</td>
                                    <td><a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-default">Edit</a></td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p> You have no posts </p>
                        @endif
                        @if(Auth::user()->verification == "notdone")
                            <Small>&emsp;&emsp;&emsp;&emsp;&emsp;: Sorry your request is not accepted yet you can't create post</small>
                        @elseif(Auth::user()->verification == "done")
                            <a href="{{url('posts/create')}}" class="btn btn-primary">Create Post</a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
