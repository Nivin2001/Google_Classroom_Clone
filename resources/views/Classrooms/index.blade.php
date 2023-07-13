
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1> My classrooms </h1>
<p> Welcome {{$name}} ,<?= $title?>    <!--تكافء جملة echo !-->
{{-- <a href="/classrooms/create">create</a> --}}
 <a href="{{ route('classrooms.create')}}">create </a>
 <a href="{{  route('classrooms.show',['1','hi']) }}">show </a>
{{--

<a href="{{route('classromms.show',$classrooms->id)}}" class="btn btn-primary">View </a>
<a href="{{route('classromms.upadte',$classrooms->id)}}" class="btn btn-primary">update </a>
<a href="{{route('classromms.destroy',$classrooms->id)}}" class="btn btn-primary">Delete </a> --}} --}}
</body>
</html>
