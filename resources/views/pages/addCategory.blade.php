@extends('layout/layout')

@section('main_contend')

    <div class="jumbotron mt-5">
        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block mb-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>

        @endif

        <h1 class="mb-4">Создать категории</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="post" action="check_category">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" aria-describedby="emailHelp" placeholder="Название категории">
            </div>
            <select class="custom-select mb-5" name="type">
                <option selected>Выберите тип</option>
                <option value="1">Доход</option>
                <option value="0">Расход</option>
            </select>
            <button type="submit" class="btn btn-primary">Создать категории</button>
        </form>




    </div>

@endsection
