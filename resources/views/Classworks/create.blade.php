{{-- @extends('Layouts.Master')

@section('title', $classwork->name)

@section('content')
<div class="container">
    <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>
    <h3>Create Classworks</h3>

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error )
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <form action="{{ route('classrooms.classworks.store', ['classroom' => $classroom->id, 'type' => $type]) }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @csrf

                <div class="form-floating mb-4">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
                    <label for="title">Title</label>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-floating mb-4 mt-3">
                    <textarea class="form-control @error('descreption') is-invalid @enderror" id="descreption" name="descreption" style="height: 100px" placeholder="Enter Classwork descreption">{{ old('descreption') }}</textarea>
                    <label for="descreption">Descreption (optional)</label>
                    @error('descreption')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary ">Create </button>
        </div>

        <div class="col-md-4">
            <div class="sidebar">
                <div>
                    <h5>Selected Students</h5>
                    @foreach ($classroom->student as $students)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="students[]" value="{{ $students->id }}" id="std-{{ $students->id }}" checked>
                        <label class="form-check-label" for="std-{{ $students->id }}">
                            {{ $students->name }}
                        </label>
                    </div>
                    @endforeach
                </div>


        <div class="form-floating mb-4 mt-3">
            <select name="topic_id" id="topic_id" class="form-select">
                <option value="">No Topic</option>
                @foreach ($classroom->topics as $topic)
                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                @endforeach
            </select>
            <label for="floatingSelect topic_id">Topic (optional)</label>
          @error('topic_id')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>


    </div>
        </div>
    </form>
</div>
</div>
@endsection

@section('styles')
<style>
    .sidebar {
        background-color: #f7f7f7;
        padding: 20px;
    }
</style>
@endsection



 --}}

 @extends('layouts.master')

@push('styles')

@endpush

@section('title' , 'Create Classwork')

@section('content')
<h1>{{ $classroom->name }} (#{{ $classroom->id }}) detailed</h1>
    <h3>Classworks</h3>
    <hr>

    <form action="{{ route('classrooms.classworks.store' , [$classroom->id , 'type' => $type]) }}" method="post" class="form-floating">
        @csrf

    <div class="row container">
        @include('Classworks._Form')
    </div>



    <button type="submit" class="btn btn-primary mx-5"> Create </button>

    </form>
@endsection
