<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <title>My Tweetz</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="/">My Tweetz </a>
            </li>
            
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <div class="container">
        <form action="{{route('post.tweet')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if (count($errors)>0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <strong>{{$error}}</strong>
                    </div>
                @endforeach
            @endif
            <div class="form-group">
              <label for="tweet">Tweet Text</label>
              <input type="text" class="form-control" name="tweet" id="tweet"  placeholder="">
            </div>
            <div class="form-group">
                    <label for="tweet">Upload Image</label>
                    <input type="file"  name="images[]" multiple id="images[]">
            </div>
            <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Create Tweet">
            </div>
        </form>
          @if (!empty($data))
              @foreach ($data as $key=>$tweet)
              <br>
              <div class="card">
                <div class="card-body">
                  <p class="card-text"> {{$tweet['text']}}.
                    <i class="fas fa-heart" aria-hidden="true"></i>{{$tweet['favorite_count']}}
                    <i class="fas fa-redo"></i>{{$tweet['retweet_count']}}
                </p>
                @if (!empty($tweet['extended_entities']['media']))
                @foreach ($tweet['extended_entities']['media'] as $img)
                    <img src="{{$img['media_url_https']}}" style="width:100px;">
                @endforeach
                @endif
                </div>
              </div>

              @endforeach
          @else
              <p>No Tweets Found ...</p>
          @endif
      </div>
</body>
</html>