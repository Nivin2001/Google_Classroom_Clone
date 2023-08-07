@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','$classroom->name')

@section('content')

{{-- flesh bootstrap --}}
<div class="container ">
    <h1>{{$classroom->name}} (# {{$classroom->id}}) </h1>
    <h3> classworks </h3>

    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
      + Create
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{route ('classrooms.classworks.create',[$clasroom->id ,type=> assigment])}}">Assigment</a></li>
          <li><a class="dropdown-item" href="{{route ('classrooms.classworks.create',[$clasroom->id ,type=> material])}}">material</a></li>
          <li><a class="dropdown-item" href="{{route ('classrooms.classworks.create',[$clasroom->id ,type=> question])}}">Question </a></li>
        </ul>
      </div>



    <div class="accordion-item">
        @forelse ( $classworks as $classwork )

        @empty

        @endforelse
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" {{$classwork->id}} data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
          {{$classwork->title}}
        </button>
      </h2>
      <div id="flush-collapseThree" class="accordion-collapse collapse" {{$classwork->id}} data-bs-parent="#accordionFlushExample">
        <div class="accordion-body">

            {{$classwork->description}}
        </div>
      </div>
    </div>
    @empty
    <p class="text-center fs-3"> Now Classworks Founds
        @endforelse
  </div>
