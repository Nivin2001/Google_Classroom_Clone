@props([
    $name
])

@php
    $name = 'success'; // Define the value of $name
$class= $name == 'error' ? 'danger' : 'success';
@endphp


@if(session()->has($name))
{{-- بدي افحص اذا كان المتغير فيه قيمة ام لا --}}
<div class="alert alert-{{$class}} {{$attributes}}">

    {{-- // يطبعلي قيمة السيشن --}}
    {{session($name)}}
</div>
@endif
