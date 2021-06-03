@extends('app')
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
                                    <p><a class="btn btn-lg btn-primary" href="{{ url('/reg') }}" role="button">Sign up today</a></p>
                                </div>
                            </div>
                        </div>
                @endforeach
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
                        <div class="des" style="height:50px; overflow: hidden;">
                            <p style="height=50px; overflow: hidden;">{{$circle_nws->description}}</p>
                        </div>
                        <p><a class="btn btn-secondary" href="{{url('circle_news/'.$circle_nws->id)}}" role="button">View details &raquo;</a></p>
                    </div>
                @endforeach
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
                    </div>
                    <div class="col-md-5">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{url('/storage/admin/square_news/'.$square_nws->file)}}" alt="first heading">
                    </div>
                @else
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">{{$square_nws->heading }}</h2>
                        <p class="lead">{{$square_nws->description}}</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" src="{{url('/storage/admin/square_news/'.$square_nws->file)}}" alt="first heading">
                    </div>
                @endif
            </div>
        @endforeach
        
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