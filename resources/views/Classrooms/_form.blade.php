


         <div class="form-floating mb-4 mt-3">
        <input type="text" value="{{old('name',$classroom->name)}}" @class(['form-control', 'is-invalid' => $errors->has('name')])
{{-- old
          return the date in the perivous reqest --}}
        id="name" name = "name" placeholder="enter classroom name">
        @error('name')
        {{-- المتغير موجود ضمن directive --}}
        <div class="text-danger">{{$message}} </div>

        @enderror
        <label for="name">ClassRoom Name</label>
      </div>

      <div class="form-floating mb-4">
        {{-- old علشان يحتفظ بالقيمة القديمة لما اعمل تحديث للمتصفح --}}
        <input type="text" value="{{old('section',$classroom->section)}}" @class(['form-control', 'is-invalid' => $errors->has('section')])id="section" name ="section" placeholder="enter section ">
        @error('section')
        <div class="text-danger">{{$message}} </div>

        @enderror
        <label for="section">Section</label>
      </div>

      <div class="form-floating mb-4">
        <input type="text" value="{{old('subject',$classroom->subject)}}" @class(['form-control', 'is-invalid' => $errors->has('subject')]) id="subject" name ="subject" placeholder="enter subject ">
        @error('subject')
        <div class="text-danger">{{$message}} </div>
        @enderror
        <label for="subject">Subject</label>
      </div>

      <div class="form-floating mb-4">
        <input type="text" value="{{old('room',$classroom->room)}}" @class(['form-control', 'is-invalid' => $errors->has('room')])id="room" name ="room" placeholder="enter room ">
        @error('room')
        <div class="text-danger">{{$message}} </div>
        @enderror
        <label for="room">Room</label>
      </div>

      <div class=" mb-3">
        @if ($classroom->cover_image_path)
            <img style="width: 100%; object-fit: cover;"
                src="{{ asset('storage/' . $classroom->cover_image_path) }}" alt="...">
        @endif

        {{-- م بحط قيمة old
        لانه لو فشلت الصورة لازم ارجع اعيد تحميلها ثاني  --}}

        <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_image')]) id="cover_image" name ="cover_image" placeholder="cover Image ">
        <label for="cover_image">Cover Image</label>
        @error('cover_image')
        <div class="text-danger">{{$message}} </div>
        @enderror

      </div>

      <button type="submit" class="btn btn-primary ">{{$button_lable}}</button>
</form>
