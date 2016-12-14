@extends('layouts.admin')

@section('app.title', 'Статистика')

@section('admin.content')
    <h1 class="page-header">Статистика</h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Топ 10 браузеров за последний час</h3>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Браузер</th>
                <th>Хиты</th>
                <th>Уники по IP</th>
                <th>Уники по кукам</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($browsers as $name => $browser)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $browser['hits'] or '0' }}</td>
                    <td>{{ $browser['uniqueIp'] or '0' }}</td>
                    <td>{{ $browser['uniqueCookie'] or '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Топ 10 систем за последний час</h3>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Система</th>
                <th>Хиты</th>
                <th>Уники по IP</th>
                <th>Уники по кукам</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($platforms as $name => $platform)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $platform['hits'] or '0' }}</td>
                    <td>{{ $platform['uniqueIp'] or '0' }}</td>
                    <td>{{ $platform['uniqueCookie'] or '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Топ 10 локаций за последний час</h3>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Локация</th>
                <th>Хиты</th>
                <th>Уники по IP</th>
                <th>Уники по кукам</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($geos as $name => $geo)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $geo['hits'] or '0' }}</td>
                    <td>{{ $geo['uniqueIp'] or '0' }}</td>
                    <td>{{ $geo['uniqueCookie'] or '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Топ 10 рефереров за последний час</h3>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Хост</th>
                <th>Хиты</th>
                <th>Уники по IP</th>
                <th>Уники по кукам</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($referers as $name => $referer)
                <tr>
                    <td>{{ $name }}</td>
                    <td>{{ $referer['hits'] or '0' }}</td>
                    <td>{{ $referer['uniqueIp'] or '0' }}</td>
                    <td>{{ $referer['uniqueCookie'] or '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Топ 10 страниц за последний час</h3>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Страница</th>
                <th>Хиты</th>
                <th>Уники по IP</th>
                <th>Уники по кукам</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($pages as $uri => $page)
                <tr>
                    <td>{{ $uri }}</td>
                    <td>{{ $page['hits'] or '0' }}</td>
                    <td>{{ $page['uniqueIp'] or '0' }}</td>
                    <td>{{ $page['uniqueCookie'] or '0' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет данных</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
