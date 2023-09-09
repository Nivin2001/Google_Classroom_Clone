@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','classrooms')

@section('content')

    <div class="container ">
    <h1>classroom</h1>

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
@if ($classroom->cover_image_path)
{{-- هيك استخدمت accessor
بدل م استخدم
<img src="storage/{{$classroom->cover_image_path}}" class="card-img-top" alt=""> --}}

    <img src="{{ $classroom->cover_image_path }}" class="card-img-top" alt="">
@else
    <img src="https://placehold.co/600x400" class="card-img-top" alt="">
@endif



            <div class="card-body">
              <h5 class="card-title">{{$classroom->name}}</h5>
            <p class="card-text">{{$classroom->section}}-{{$classroom->room}}</p>
            <div class="d-flex justify-content-between">

                    <a href="{{ $classroom->url }}" class="btn btn-sm btn-primary">View</a>
                    <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-sm btn-success">Edit</a>

                                    <form action="{{route('classrooms.destroy',$classroom->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-small btn-danger">Delete </button>
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





