@extends('backend.layouts.master')

@section('title','list quiz')

@section('content')

    <div class="span9">
        <div class="content">

            @if(Session::has('message'))
                <div class="alert alert-success">{{Session::get('message')}}</div>
            @endif

            <div class="module">
                <div class="module-head">
                    <h3>All Quiz</h3>
                </div>

                <div class="module-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ad</th>
                                <th>Açıklama</th>
                                <th>Dakika</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if(count($quizzes)>0)
                                @foreach($quizzes as $key=>$quiz)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$quiz->name}}</td>
                                        <td>{{$quiz->description}}</td>
                                        <td>{{$quiz->minutes}}</td>
                                        <td>
                                            <a href="{{route('quiz.question',[$quiz->id])}}">
                                                <button class="btn btn-inverse">Soruyu Görüntüle</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('quiz.edit',[$quiz->id])}}">
                                                <button class="btn btn-primary">Düzenle</button>
                                            </a>
                                        </td>
                                        <td>
                                            <form id="delete-form{{$quiz->id}}" method="POST" action="{{route('quiz.destroy',[$quiz->id])}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            </form>

                                            <a href="#"
                                               onclick="
                                               if(confirm('Silmek istiyor musun?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form{{$quiz->id}}').submit()
                                               }else{
                                               event.preventDefault();
                                               }
                                                ">
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td>Gösterilecek sınav yok</td>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
