@include('partial.header')

    <div class="container ">

    <h1>Edit Topic</h1>
    <form action={{route('topics.update',$topics->id)}}  method="post">

         @csrf
         @method('put')
         <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="name" value="{{$topics->name}}" name = "name" placeholder="enter topic name">
            <label for="name">Topic Name</label>
          </div>

          <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="Description" value="{{$topics->Description}}" name = "Description" placeholder="enter Description ">
            <label for="Description">Description</label>
          </div>

          <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="classroom_id" value="{{$topics->classroom_id}}" name = "classroom_id" placeholder="enter classroom_id">
            <label for="classroom_id">classroom_id</label>
          </div>

          <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="name" value="{{$topics->user_id}}" name = "user_id" placeholder="enter user_id">
            <label for="user_id"></label>
          </div>


          <button type="submit" class="btn btn-primary ">update Topic</button>
    </form>
</div>
@include('partial.footer');

