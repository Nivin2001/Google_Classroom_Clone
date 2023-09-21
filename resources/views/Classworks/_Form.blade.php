@if(session()->has('error'))
    <div class="alert alert-danger container">
        {{ session()->get('error') }}
    </div>
@endif

<div class="col-md-8">
    <div class="form-floating mb-4 mt-3">
        <input type="input" value="{{old('title',$classwork->title)}}" @class(['form-control', 'is-invalid' => $errors->has('title')]) id="title" name = "title" placeholder="Enter Classwork Title" value={{ old('title',$classwork->title) }} >
        <label for="title">Title</label>
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>


    <div class="form-floating mb-4 mt-3">
        <textarea  value="{{old('descreption',$classwork->description)}}" @class(['form-control', 'is-invalid' => $errors->has('description')]) id="description" name="	description" style="height: 100px" placeholder="Enter Classwork descreption" value="{{old('descreption',$classwork->description)}}"></textarea>
        <label for="descreption">Descreption (optional)</label>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

    </div>
</div>
<div class="col-md-4">

   <div class="form-floating mb-4 mt-3">
        <input type="date" @class(['form-control', 'is-invalid' => $errors->has('published_at')])
        id="published_at" name = "published_at" value="{{old('published_at',$classwork->published_at)}}">
        <label for="published_at">publish Date</label>
        @error('published_at')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


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

        @php
        $urlType = request('type'); // Get the 'type' parameter from the URL
    @endphp

    @if ($type == "assignment" || $urlType == "assignment")
        <div class="form-floating mb-4 mt-3">
            <input type="number" min="0" class="form-control {{ $errors->has('options.grade') ? 'is-invalid' : '' }}" id="grade" name="options[grade]"
                   value="{{ old('options.grade', $classwork->options['grade'] ?? '') }}">
            <label for="grade">Grade</label>
            @error('options.grade')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-floating mb-4 mt-3">
            <input type="date" class="form-control {{ $errors->has('options.due') ? 'is-invalid' : '' }}" id="due" name="options[due]"
                   value="{{ old('options.due', $classwork->options['due'] ?? '') }}">
            <label for="due">Due</label>
            @error('options.due')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    @endif



    <div class="form-floating mb-3 mt-3">
        <select name="topic_id" id="topic_id" class="form-select">
            <option value="">No Topic</option>
            @foreach ($classroom->topics as $topic)
            <option @selected($topic->id == $classwork->topic_id) value="{{ $topic->id }}">{{ $topic->name }}</option>
            @endforeach
        </select>
        <label for="floatingSelect topic_id">Topic (optional)</label>
      @error('topic_id')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
</div>
    @push('styles')
<!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    @endpush



  @push('scripts')
    <script src="https://cdn.tiny.cloud/1/p0p17ajz76k68e8fz4oms3wxq9rf12gygwagcmy72uz0kms2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
  selector: '#description',
  // ... other configuration options ...
  setup: function (editor) {
    editor.on('init', function () {
      console.log('TinyMCE initialized successfully');
    });
    editor.on('Error', function (e) {
      console.error('TinyMCE Error:', e);
    });
  }
});

      </script>
@endpush
