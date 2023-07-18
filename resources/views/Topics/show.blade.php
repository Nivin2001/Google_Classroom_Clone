@include('partial.header');

    <div class="container ">
    <h1>{{$topics->name}} (# {{$topics->id}})</h1>
    <h3> {{$topics->Descrption}} </h3>
    <div class="row">
        <div class="col-md-3">
          <div class="border-rounded p-3 text-center">
            <p>  User Id</p>
          <span   class="text-sucess fs-2">  {{$topics->user_id}}  </span>
          <p>  Classroom Id</p>
          <span classroom_id  class="text-sucess fs-2">  {{$topics->classroom_id}} </span>

          </div>
        </div>
        <div class="col-md-9"></div>
    </div>
    @include('partial.footer');
