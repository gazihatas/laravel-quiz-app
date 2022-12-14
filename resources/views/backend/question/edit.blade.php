@extends('backend.layouts.master')

@section('title','create question')

@section('content')
    <div class="span9">
        <div class="content">

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif

            <form action="{{route('question.update',[$question->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="module">
                    <div class="module-head">
                        <h3>Soruyu Güncelle</h3>
                    </div>

                    <div class="module-body">
                        <div class="control-group">
                            <div class="control-label" >Testi Seçin</div>
                            <div class="controls">
                                <select name="quiz" class="span8">
                                    @foreach(App\Models\Quiz::all() as $quiz)
                                        <option value="{{$quiz->id}}"
                                                @if($quiz->id==$question->quiz_id)
                                                    selected
                                                @endif>
                                            {{$quiz->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('question')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="module-body">
                        <div class="control-group">
                            <label class="control-label">Soru Adı</label>
                            <div class="controls">
                                {{--
                                <input type="text" name="question" value="{{$question->question}}" class="span8" placeholder="name of a quiz">
                                --}}
                                <textarea class="form-control mt-5" name="question" id="editor">{!! $question->question !!}</textarea>
                                @error('question')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="control-group">
                                <label class="control-label">Seçenekler</label>
                                <div class="controls">
                                    @foreach($question->answers as $key=>$answer)
                                        <input type="text" name="options[]" class="span7" value="{{$answer->answer}}" required>

                                        <input type="radio" name="correct_answer" value="{{$key}}"
                                            @if($answer->is_correct)
                                                {{'checked'}}
                                            @endif>
                                        <span>Doğru cevap mı?</span>
                                    @endforeach

                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                            </div>
                        </div>

                        <div class="module-body">
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-success">Kaydet</button>
                                </div>
                            </div>
                        </div>

                    </div>

            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),
                {
                    ckfinder:{
                        uploadUrl:"{{ route('ckeditor.upload').'?_token='.csrf_token()}}"
                    }
                } )
            .then( editor => {
                console.log( editor );
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
