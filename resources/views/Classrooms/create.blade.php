
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create ClassRoom</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </head>
  <body>
    <header class="mb-3">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
              <a class="navbar-brand" href="{{ route('classrooms.index')}}">{{ config('app.name' ,'laravel') }}</a>
              {{--  بقرا القيمة بشكل مباشر من ملف config}}
              {{-- key in config (filename.key) --}}
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Dropdown
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled">Disabled</a>
                  </li>
                </ul>
                <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
              </div>
            </div>
          </nav>
    </header>

    <div class="container ">
    <h1>create classroom</h1>
    <form action={{route('classrooms.store')}}  method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         {{ csrf_field() }}
         @csrf 
        <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="name" name = "name" placeholder="enter classroom name">
            <label for="name">ClassRoom Name</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="section" name ="section" placeholder="enter section ">
            <label for="section">Section</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="subject" name ="subject" placeholder="enter subject ">
            <label for="subject">Subject</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="room" name ="room" placeholder="enter room ">
            <label for="room">Room</label>
          </div>

          <div class="form-floating mb-4">
            <input type="file" class="form-control" id="cover_image" name ="cover_image" placeholder="cover Image ">
            <label for="cover_image">Cover Image</label>
          </div>

          <button type="submit" class="btn btn-primary ">Create ClassRoom</button>
    </form>
</div>

