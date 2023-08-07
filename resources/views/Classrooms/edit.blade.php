@extends('Layouts.Master')
{{-- // علشان احكي ان هاد الملف بستخدم هاد layouts --}}
@section('title','Edit classrooms . $classroom->name')

@section('content')

    <div class="container ">

    <h1>Edit classroom</h1>
    <form action={{route('classrooms.update',$classroom->id)}}  method="post">

         @csrf
         {{-- اي ميثود مش بطريقة
             لازم تحتوي على csrf --}}

         <!-- form hidden sppofing-->
      <!-- form hidden spoofing -->

{{-- <input type="hidden" name="_method" value="put">

         {{ method_field('put')}} --}}
         @method('put')
         {{-- لاني الدالة عندي put
         م بقدرر امرر في الفورم الا post --}}
         {{-- @include('Classrooms._form') --}}
           @include('Classrooms._form',[
            'button_lable'=>'Update Classroom'
         ])
         

          {{-- <img src="/storage/{{$classroom->cover_image_path}}" class="card-img-top" alt=""> --}}
          {{-- بدي الصورة تظهر عندي --}}
{{--
                 <img src="{{asset('storage/'.$classroom->cover_image_path)}}" class="card-img-top" alt="">

          <div class="form-floating mb-4">
            <input type="file" class="form-control" id="cover_image" name ="cover_image" placeholder="cover Image ">
            <label for="cover_image">Cover Image</label>
          </div>

          <button type="submit" class="btn btn-primary ">update ClassRoom</button> --}}
    </form>
</div>

@endsection
