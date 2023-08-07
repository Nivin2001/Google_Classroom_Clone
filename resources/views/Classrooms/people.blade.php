@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','$classroom->name')

@section('content')

<div class="container ">

    <h1>{{$classroom->name}} people </h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @foreach ($classrooms->users()->orderby('name')->get as $user )


          <tr>
            <td> </td>
            <td> {{$user->name}} </td>
            <td> {{$user->jion->role}}</td>
            <td> </td>
          </tr>

        </tbody>
      </table>

      @endforeach


@endsection
