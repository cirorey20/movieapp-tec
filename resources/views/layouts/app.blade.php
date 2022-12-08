<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body >
    <div id="app">
        <!-- As a link -->
  
  <!-- As a heading -->

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">MoviesApp</span>
        <a href="{{ url('/movies') }}" class="btn btn-success">Upload</a>
        </div>
    </nav><br><br>





    <div class="container my-5">
        <h1 class="text-center">Latest Movies</h1> 
        <div class="row d-flex justify-content-center m-4">
          <!--COLUMNA-->
            @foreach ($movie as $item)
            <div class="card m-3" style="width: 18rem;">
                <img src="https://media.istockphoto.com/id/1191001701/photo/popcorn-and-clapperboard.jpg?s=612x612&w=0&k=20&c=iUkFTVuU8k-UCcZDxczTWs6gkRa0nAMihp2Jf_2ASKM=" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title">{{$item->name}}</h5>
                  <p class="card-text">{{$item->original_title}}</p>
                  <a href="{{ url('/detail/') }}/{{ $item->id }}" class="btn btn-secondary">:) Info</a>
                </div>
              </div>
            @endforeach
        </div>
      </div>









        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
