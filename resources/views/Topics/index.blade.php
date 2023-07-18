@include('partial.header');

    <div class="container ">
    <h1>Topics</h1>

    <div class="row">

        @foreach ($topic as $topic)
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img src="" class="card-img-top" alt="">
                <div class="card-body">
                  <h5 class="card-title">{{$topic->name}}</h5>
                <p class="card-text">{{$topic->Descrption}}</p>
                <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-sm btn-primary">View</a>
                <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-sm btn-primary">Edit</a>
{{-- لانه طريقة الارسال delete
م بنفع استخدم link --}}
                             <form action="{{route('topics.destroy',$topic->id)}}" method="post">
                    @csrf
                    @method('delete')
                     <button type="submit" class="btn btn-small btn-danger">Delete </button>
                </div>
              </div>

        </div>
        @endforeach
    </div>
    </div>
    @include('partial.footer');
