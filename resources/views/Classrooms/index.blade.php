@include('partial.header');

    <div class="container ">
    <h1>classroom</h1>

    <x-alert/>
    
    <div class="row">

    @foreach ($classroom as $classroom)
    <!--
        item inside the collection is the object of model
        عملت array
         ع ابجكت المودل
        لذلك بقدر اوصل للعناصر الموجودة فيه عن طريق اسم  الحقل
    -->
    {{-- <li> {{$classroom->name}} </li> --}}
    <div class="col-md-3">
        <div class="card" style="width: 18rem;">
            <img src="" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title">{{$classroom->name}}</h5>
            <p class="card-text">{{$classroom->section}}-{{$classroom->room}}</p>
            <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-sm btn-primary">View</a>
            <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-sm btn-primary">Edit</a>

                         <form action="{{route('classrooms.destroy',$classroom->id)}}" method="post">
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





