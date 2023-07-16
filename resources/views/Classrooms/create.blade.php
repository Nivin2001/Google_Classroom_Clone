@include('partial.header')

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
@include('partial.footer');

