

@extends('Layouts.Master')

@section('title', $classrooms->name)

@section('content')
<div class="container">
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

    <h1>{{ $classrooms->name }} People</h1>

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

            @foreach ($classrooms->users()->orderBy('name')->get() as $index => $user)
            <tr class="{{ ($index % 2 == 1) ? 'custom-row-style' : '' }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->join->role }}</td>
                <td>
                    <form action="{{ route('classrooms.people.destroy', $classrooms->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection

@push('styles')
<style>
    .custom-row-style {
        /* Apply your custom styles here for the second row */
        background-color: #f7f7f7;
    }
</style>
@endpush
