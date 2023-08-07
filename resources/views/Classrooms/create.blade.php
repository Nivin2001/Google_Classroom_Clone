@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','classrooms')

@section('content')

    <div class="container ">

    <h1>create classroom</h1>

    @if($errors->any())
    {{-- اذا كان  يوجد اي ايرور  --}}
    {{-- //validation --}}
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error )
        <li> {{$error}} </li>

        @endforeach
         </div>
         @endif

    <form action={{route('classrooms.store')}}  method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         {{ csrf_field() }}
         @csrf
         @include('Classrooms._form',[
            'button_lable'=>'Create Room'
         ])

    </form>
</div>

@endsection

