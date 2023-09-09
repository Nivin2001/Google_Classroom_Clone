@extends('Layouts.Master')

{{-- This file uses the specified layout --}}
@section('title', 'Classrooms')

@section('content')
<div class="container">
    <h1>Classroom</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row">
        <div class="d-flex align-items-center justify-content-center ">
            <div >
                {{-- Display classroom name --}}
                <h2 class="mb-0">{{ $classroom->name }}</h2>
            </div>
        </div>

        <

            <form class=" d-flex flex-column align-items-center" action="{{ route('classrooms.join', $classroom->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Join button --}}
                <button type="submit" class="btn btn-primary">{{ __('Join') }}</button>
            </form>
        </div>


@endsection
