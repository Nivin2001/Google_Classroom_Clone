@include('partial.header')

    <div class="container ">

    <h1>create classroom</h1>
    <form action={{route('Topics.store')}}  method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         {{ csrf_field() }}
         @csrf
             <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="name" name = "name" placeholder="enter Topic name">
            <label for="name">Topic Name</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="Description" name ="Description" placeholder="enter Description ">
            <label for="room">Room</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="Title" name ="Title" placeholder="enter Title ">
            <label for="room">Room</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="user_id" name ="user_id" placeholder="enter user_id ">
            <label for="section">Section</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="classroom_id" name ="classroom_id" placeholder="classroom_id">
            <label for="subject">Subject</label>
          </div>





          <button type="submit" class="btn btn-primary ">Create Topics</button>
    </form>
</div>
@include('partial.footer');
