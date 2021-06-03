@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container">
            <div class="row">
                    <div id="comment-form" class="col-md-12 col-md-offset-2" style = "margin-left:30px;">
                        {{ Form::open(['route' =>['comments.update', $comment->id], 'method' => 'POST'])}}
                        <div class="row">
                            <div class="col-md-10">
                                {{Form::label('comment', 'Comment:')}}
                                {{Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'rows=3'])}}
                            </div>
                            <div class="col-md-3" style = "margin-top:5px; float:left;">
                                {{Form::submit('Update', ['class'=>"btn btn-success btn-block"])}}
                                {!!Form::close()!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3" style = "margin-top:5px;">
                                <a onclick="return confirm('Do you want to delete??')" href="{{url('comment/delete/'.$comment->id)}}"><button class="btn btn-danger btn-block"> Delete comment</button></a>&emsp;&emsp;&emsp;&emsp;<br>
                            </div>
                        </div>
                    </div>
            </div><br><hr><br>
        </div>
    </div>
</div>
@endsection
