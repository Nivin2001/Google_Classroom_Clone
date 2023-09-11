@extends('Layouts.Master')

@section('title', $classroom->name)

@section('content')
<div class="container">
    <h1>{{ $classroom->name }} (#{{ $classroom->id }})</h1>

    <h3>{{ $classwork->title }}</h3>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

    <hr>

    <div class="row">
        <div class="col-md-8">

            <div>
              <h3 style="font-weight: lighter">{{ $classwork->description }}</h3>

                <h4> comments </h4>
            </div>

            <form action="{{ route('comments.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $classwork->id }}">
                <input type="hidden" name="type" value="classwork">

                <div class="form-floating mb-4 mt-3">
                    <input type="input" class="form-control @error('content') is-invalid @enderror" id="content"
                        name="content" placeholder="Enter Your Comment" value="{{ old('content') }}">
                    <label for="content">Comment</label>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Comment</button>
            </form>

            <div class="mt-4 container ms-5">
                @foreach ($classwork->comments as $comment)
                <div class="row container">
                    <div class="col-md-1">
                        <img
                            src="https://ui-avatars.com/api/?name={{ $comment->user->name }}&background=random&size=55&rounded=true"
                            alt="">
                    </div>
                    <div class="col-md-11">
                        <p>By: {{ $comment->user->name }}. Time: {{ $comment->created_at->diffForHumans(null, false, true) }}</p>
                        <p>{{ $comment->content }}</p>
                        <hr>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-4">

            <div class="bordered rounded p-3 bg-secondary bg-gradient ">
                <h4>Submissions</h4>
                @can('submissions.create',[$classwork])
                @if($submissions->count())
                <ul>
                    @foreach ($submissions as $submission)
                        <li>
                            <a href="{{ route('submissions.file', $submission->id) }}">File #{{$loop->iteration}}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No submissions available.</p>
            @endif


                <form action="{{ route('submissions.store', $classwork->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-5 mt-3">
                        <input type="file" class="form-control @error('files') is-invalid @enderror" multiple
                            id="files" name="files[]" placeholder="Select Files" value="">
                        <label for="files">Upload File</label>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        @error('files')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            @endcan

        </div>
    </div>
</div>
@endsection
