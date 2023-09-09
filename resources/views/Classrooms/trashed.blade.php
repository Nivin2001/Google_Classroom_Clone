@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','classrooms')

@section('content')

    <div  class="container ">
    <h1 style="margin: 20px">Trashed classroom</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    {{-- <x-alert  name="success" id="success"/>
    <x-alert  name="error" id="error"/> --}}

    <div class="row">

    @foreach ($classroom as $classroom)
    <!--
        item inside the collection is the object of model
        عملت array
         ع ابجكت المودل
        لذلك بقدر اوصل للعناصر الموجودة فيه عن طريق اسم  الحقل
    -->
    {{-- <li> {{$classroom->name}} </li> --}}
    <div class="col-md-3">
        <div class="card" style="width: 18rem;">
{{-- @if($classroom->cover_image_path) --}}
            <img src="storage/{{$classroom->cover_image_path}}" class="card-img-top" alt="">

            <div class="card-body">
              <h5 class="card-title">{{$classroom->name}}</h5>
            <p class="card-text">{{$classroom->section}}-{{$classroom->room}}</p>


            {{-- عبارى عن block element
            علشان احولهم الى inline
            بستخدم d-flex --}}
            <div class="d-flex justify-content-between">
            <form action="{{route('classrooms.restore',$classroom->id)}}" method="post">
                @csrf
                @method('put')
                <button type="submit" class="btn btn-small btn-success">Restore </button>
                         </form>


                         <form action="{{route('classrooms.force-delete',$classroom->id)}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-small btn-danger">Delete For Over </button>
                         </form>
            </div>
          </div>

    </div>
</div>
    @endforeach
</div>
</div>

@endsection

@pushif(true,'scripts')
<script> console.log('@@stack') </script>
@endpushif()





