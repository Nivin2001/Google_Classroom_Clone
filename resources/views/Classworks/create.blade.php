@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','$classroom->name')

@section('content')



<div class="container ">
    <h1>{{$classroom->name}} (# {{$classroom->id}}) </h1>
    <h3> classworks </h3>

    <hr>

    <form action="{{'classrooms.classworks.store',[$classroom->id,'type'=>]}}" method="post">
