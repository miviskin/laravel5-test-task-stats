@extends('layouts.app')

@section('app.title', 'Авторизация')

@section('app.content')
    <div class="container">

        <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}

            <h2 class="form-signin-heading">Авторизация</h2>

            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email') ?: 'admin@email.com' }}" placeholder="Email адрес" required autofocus>

            <label for="inputPassword" class="sr-only">Пароль</label>
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Пароль (admin)" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Запомнить меня
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
        </form>

    </div><!-- /container -->
@endsection
