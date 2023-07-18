@include('partial.header')

    <div class="container ">

    <h1>create Topic</h1>
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
            <label for="Description">Description</label>
          </div>


          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="user_id" name ="user_id" placeholder="enter user_id ">
            <label for="user_id">user_id</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="classroom_id" name ="classroom_id" placeholder="enter classroom_id">
            <label for="classroom_id">classroom_id</label>
          </div>

          <button type="submit" class="btn btn-primary ">Create Topics</button>
    </form>
</div>
@include('partial.footer');
