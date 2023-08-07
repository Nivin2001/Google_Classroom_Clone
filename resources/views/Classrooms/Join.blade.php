<div class="d-flex align-items-center justify-cintent vh-100">

    <div class="border p-5"> </div>
    <h2 class="mb-4"> {{$classroom->name}} </h2>
</div>
<form class="border p-5" action={{route('classrooms.join')}}  method="post" enctype="multipart/form-data">

     {{ csrf_field() }}
     @csrf
     <button type="submit" class="btn btn-primary">{{__('join')}} </button>
</form>
</div>
