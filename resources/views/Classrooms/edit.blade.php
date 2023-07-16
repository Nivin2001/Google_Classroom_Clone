@include('partial.header')

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

             <div class="form-floating mb-4 mt-3">
            <input type="text" class="form-control" id="name" value="{{$classroom->name}}" name = "name" placeholder="enter classroom name">
            <label for="name">ClassRoom Name</label>
          </div>
{{-- لازم امرر القيم الحالية الموجودة عندي علشان اشوف شو بدي اعدل --}}
          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="section" value="{{$classroom->section}}" name ="section" placeholder="enter section ">
            <label for="section">Section</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="subject" value="{{$classroom->subject}}" name ="subject" placeholder="enter subject ">
            <label for="subject">Subject</label>
          </div>

          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="room" value="{{$classroom->room}}" name ="room" placeholder="enter room ">
            <label for="room">Room</label>
          </div>

          <div class="form-floating mb-4">
            <input type="file" class="form-control" id="cover_image" name ="cover_image" placeholder="cover Image ">
            <label for="cover_image">Cover Image</label>
          </div>

          <button type="submit" class="btn btn-primary ">update ClassRoom</button>
    </form>
</div>
@include('partial.footer');
