@extends('multiauth::layouts.app')
<?php use App\Slide;
use App\CircleNews;
use App\SquareNews;
$slides = Slide::all();
$circle_news = CircleNews::all();
$square_news = SquareNews::all();
$count = 0;
$dcount=0;
?>
@section('content')
<main role="main">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php for($i=0;$i<=count($slides);$i++){ ?>
                    @if($i == 0)
                        <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                    @else
                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                    @endif
            <?php } ?>
        </ol>
        <div class="carousel-inner">
            @if(count($slides)>0)
                @foreach ($slides as $slide)
                    <?php $count++; ?>
                    @if($count==1)
                        <div class="carousel-item active">
                    @else
                        <div class="carousel-item">
                    @endif
                            <img class="first-slide" src="{{url('/storage/admin/slides/'.$slide->file)}}" alt="First slide">
                            <div class="container">
                                <div class="carousel-caption">
                                    <h1>{{$slide->heading}}</h1>
                                    <p>{{$slide->description}}</p>
                                    {!!Form::open(['action' => ['Admin\SlideController@destroy', $slide->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    <a class="btn btn-lg btn-primary" href="{{ url('/slide/'.$slide->id.'/edit') }}" role="button">Edit this slide</a>
                                    {{Form::submit('Delete this slide', ['class'=>"btn btn-lg btn-danger", 'float'=> 'left'])}}
                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                @endforeach
            @endif
            @if(count($slides)==0)
                <div class="carousel-item active">
                    <img class="third-slide" src="{{url('/storage/slider images/add.png')}}" alt="second slide">
                    <div class="container">
                      <div class="carousel-caption">
                        <!-- <div class="carousel-caption text-right"> !-->
                        <p><a class="btn btn-lg btn-primary" href="{{url('slide/create')}}" role="button">Add new slide</a></p>
                      </div>
                    </div>
                </div>
            @else
                <div class="carousel-item">
                    <div class="container">
                        <div class="carousel-caption">
                        <!-- <div class="carousel-caption text-right"> !-->
                            <p><a class="btn btn-lg btn-primary" href="{{url('slide/create')}}" role="button">Add new slide</a></p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>    
          <!-- Marketing messaging and featurettes
          ================================================== -->
          <!-- Wrap the rest of the page in another container to center all the content. -->
        
          <div class="container marketing">
        
            <!-- Three columns of text below the carousel -->
            <div class="row">
                @foreach ($circle_news as $circle_nws)
                    <div class="col-lg-4">
                        <img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{url('/storage/admin/circle_news/'.$circle_nws->file)}}" alt="first heading">
                        <h2>{{$circle_nws->heading}}</h2>
                        <p>{{$circle_nws->description}}</p>
                        {!!Form::open(['action' => ['Admin\CircleNewsController@destroy', $circle_nws->id], 'method' => 'POST'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        <a class="btn btn-secondary" href="{{url('/circle_news/'.$circle_nws->id.'/edit')}}" role="button">Edit News</a>                        
                        {{Form::submit('Delete', ['class'=>"btn btn-danger", 'float'=> 'left'])}}
                        {!!Form::close()!!}
                    </div>
                @endforeach
              <div class="col-lg-4">
                <a href="{{url('circle_news/create')}}"><img class="bd-placeholder-img rounded-circle" width="140" height="140" src="{{url('/storage/slider images/add1.png')}}" alt="third heading"></a>
                <p><a class="btn btn-secondary" href="{{url('circle_news/create')}}" role="button">Add New</a></p>
              </div>      <!-- /.col-lg-4 -->
            </div><!-- /.row -->
        
        
            <!-- START THE FEATURETTES -->
        @foreach ($square_news as $square_nws)
            <?php $dcount++; ?>
            <hr class="featurette-divider">
            <div class="row featurette">
                @if($dcount % 2 ==1 )
                    <div class="col-md-7">
                        <h2 class="featurette-heading">{{$square_nws->heading}}</h2>
                        <p class="lead">{{$square_nws->description}}</p>
                        {!!Form::open(['action' => ['Admin\SquareNewsController@destroy', $square_nws->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            <a class="btn btn-secondary" href="{{url('/square_news/'.$square_nws->id.'/edit')}}" role="button">Edit News</a>                        
                            {{Form::submit('Delete', ['class'=>"btn btn-danger", 'float'=> 'left'])}}
                        {!!Form::close()!!}
                    </div>
                    <div class="col-md-5">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{url('/storage/admin/square_news/'.$square_nws->file)}}" alt="first heading">
                    </div>
                @else
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">{{$square_nws->heading }}</h2>
                        <p class="lead">{{$square_nws->description}}</p>
                        {!!Form::open(['action' => ['Admin\SquareNewsController@destroy', $square_nws->id], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            <a class="btn btn-secondary" href="{{url('/square_news/'.$square_nws->id.'/edit')}}" role="button">Edit News</a>                        
                            {{Form::submit('Delete', ['class'=>"btn btn-danger", 'float'=> 'left'])}}
                        {!!Form::close()!!}
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{url('/storage/admin/square_news/'.$square_nws->file)}}" alt="first heading">
                    </div>
                @endif
            </div>
        @endforeach
            <hr class="featurette-divider">
            <div class="row featurette">
                <div class="offset-4 col-md-4 offset-4">
                    <p><a class="btn btn-lg btn-secondary" href="{{url('square_news/create')}}" role="button">Add New Features</a></p>                    
                </div>
            </div>
        
            <hr class="featurette-divider">
        
            <!-- /END THE FEATURETTES -->
        
          </div><!-- /.container -->
        
        
          <!-- FOOTER -->
          <footer class="container">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>&copy; 2017-2018 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
          </footer>
        </main>
@endsection