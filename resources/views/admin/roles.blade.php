@extends('welcome')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                @if(session()->has('success'))
                    @if(session()->get('success'))
                        <div class="alert alert-success">Роль успешно изменена!</div>
                    @else
                        <div class="alert alert-success">У вас нет доступа!</div>
                    @endif
                @endif

                <h2>Роли: </h2>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Индификатор</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Наименование на английском</th>
                            <th scope="col">Редактирование</th>
                            <th scope="col">Удаление</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($roles))
                            <?php $allPrice = 0; ?>
                            <form method="POST">
                                @csrf
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->EN_name}}</td>
                                        <td><button class="btn btn-success" id="roleEdit_{{$role->id}}" type="submit">Редактирование</button></td>
                                        <td><button class="btn btn-danger" id="roleDelete_{{$role->id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit">Удаление</button></td>
                                    </tr>
                                @endforeach
                            </form>
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Пока ролей нет!</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Удалить роль {{$role->EN_name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы точно хотите удалить роль
                    {{$role->EN_name}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <form action="{{route('admin.roles.destroy', ['role' => $role->id])}}" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <button type="submit" class="btn btn-danger">Да, я точно хочу удалить данную роль</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
