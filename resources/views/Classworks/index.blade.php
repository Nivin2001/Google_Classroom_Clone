@extends('Layouts.Master')

@push('styles')
    <!-- Add any additional styles here -->
@endpush

@section('title', $classroom->name)

@section('content')
<div class="container mt-4"> <!-- Add margin-top class for spacing -->

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <h1>{{ $classroom->name }} (#{{ $classroom->id }}) detailed</h1>
    <h3>Classworks
        {{-- @if(Gate::allows('classworks.create',[$classroom])) --}}

        @can('create',['App\Models\Classwork',$classroom])
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                + create
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item"
                        href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'assignment']) }}">Assignment</a>
                </li>
                <li><a class="dropdown-item"
                        href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'material']) }}">Material</a>
                </li>
                <li><a class="dropdown-item"
                        href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'question']) }}">Question</a>
                </li>
            </ul>
        </div>
   @endcan

    </h3>
    <hr>
    <!-- Search Form -->
    <form action="{{ URL::current() }}" method="get" class="row row-cols-lg-auto g-3 align-items-center">
        <div class="col-12">
            <input type="text" name="search" class="form-control">
        </div>
        <div class="col-12 mt-2"> <!-- Add margin-top class for spacing -->
            <button class="btn btn-primary" type="submit">Find</button>
        </div>
    </form>
    <!-- End Search Form -->

    <!-- Classworks Listing -->
    @forelse ($classwork as $i => $classworkItem)
    <div class="mt-4"> <!-- Add margin-top class for spacing -->
        <h3>Topic Name: {{ $classworkItem->topic->name ?? 'No Topic' }}</h3>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{ $classworkItem->id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $classworkItem->id }}">
                        Classwork Title: {{ $classworkItem->title }}
                    </button>
                </h2>
                <div id="flush-collapse{{ $classworkItem->id }}" class="accordion-collapse collapse"
                    aria-labelledby="flush-heading{{ $classworkItem->id }}" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">


                               @if ($classworkItem->description)
                                {!! $classworkItem->description !!}
                            </div>
                            @else
                            No description available.
                        @endif

                            <div class="col-md-6 row">
                                <div class="col-md-4">
                                    <div class="fs-3">
                                        {{ $classworkItem->users->count() }}

                                    </div>
                                    <div Assigned Users: class="text-muted">{{ __('Assigned') }}</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="fs-3">
                                        {{ $classworkItem->turnedin_count }}
                                    </div>
                                    <div class="text-muted">{{ __('Turned In') }}</div>
                                </div>

                                <div class="col-md-4">
                                    <div class="fs-3">
                                        {{ $classworkItem->graded_count }}
                                    </div>
                                    <div class="text-muted">{{ __('Graded') }}</div>
                                </div>




                        <div class="mt-2"> <!-- Add margin-top class for spacing -->
                            @foreach ($classwork as $singleClasswork)
                            @if (is_object($singleClasswork) && isset($singleClasswork->classroom))

                            <a class="btn btn-sm btn-outline-success"
                            href="{{ route('classrooms.classworks.show', [$singleClasswork->classroom->id, $singleClasswork->id]) }}">
                            Show
                        </a>
                                <a class="btn btn-sm btn-outline-dark"
                                    href="{{ route('classrooms.classworks.edit', [$singleClasswork->classroom->id, $singleClasswork->id]) }}">
                                    Edit
                                </a>
                                @break <!-- Exit the loop after generating the first link -->
                            @endif


                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <p class="text-center fs-3 mt-4">No Classwork yet.</p> <!-- Add margin-top class for spacing -->
    @endforelse
    <!-- End Classworks Listing -->

    <!-- Pagination -->
    <div class="mt-4"> <!-- Add margin-top class for spacing -->
        {{ $classwork->withQueryString()->appends(['v1' => 1])->links('vendor.pagination.bootstrap-5') }}
    </div>
    <!-- End Pagination -->
</div>

@push('scripts')
{{-- <script>
// "{{ $classwork->classroom_id}}"
    dd($classwork)
</script> --}}

@endpush





@endsection






