@extends('welcome')

{{--Секция для вывода всех постов--}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-10">
                @if(session()->has('success'))
                    @if(session()->get('success'))
                        <div class="alert alert-success">Пост успешно удален!</div>
                    @else
                        <div class="alert alert-danger">Вы не имеете доступа к данному посту!</div>
                    @endif
                @endif
                <h1>Все посты</h1>
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-4 mt-2">
                            <div class="card" style="width: 100%;">
                                <img src="/public/storage/{{$post->photo}}" class="card-img-top" alt="{{$post->name}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$post->name}}</h5>
                                    <p class="card-text">{{$post->short_description}}</p>
                                    <a href="{{route('posts.show', ['post' => $post->id])}}" class="btn btn-primary">Посмотреть</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="p-2 mb-2 mt-2">{{$posts->links()}}</div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
