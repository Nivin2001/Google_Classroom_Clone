@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','$classroom->name')

@section('content')

    <div class="container ">
    <h1>{{$classroom->name}} (# {{$classroom->id}})</h1>
    <h3> {{$classroom->section}} </h3>
    <div class="row">
        <div class="col-md-3">
          <div class="border-rounded p-3 text-center">
          <span class="text-sucess fs-2">  {{$classroom->code}} </span>

          </div>
        </div>
        <div class="col-md-9"></div>
        <p>
            <a href="{{route('classrooms.classworks.index')}}" target="_blank" >Classwork </a>
        </p>
    </div>

    @endsection

