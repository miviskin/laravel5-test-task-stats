@extends('layouts.app')

@section('app.title', 'Админка')

@section('app.content')
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin">Админка</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            {{--<li><a href="#">Dashboard</a></li>--}}
            {{--<li><a href="#">Settings</a></li>--}}
            {{--<li><a href="#">Profile</a></li>--}}
            {{--<li><a href="#">Help</a></li>--}}
            <li><a href="/logout">Выход</a></li>
            </ul>
            {{--<form class="navbar-form navbar-right">--}}
            {{--<input type="text" class="form-control" placeholder="Search...">--}}
            {{--</form>--}}
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="/admin">Статистика</a></li>
                    {{--<li><a href="#">Пользователи</a></li>--}}
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                @yield('admin.content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="application/javascript">
        $(function () {
            // www.daterangepicker.com
            $('input.period-stats').daterangepicker({
                timePicker: true,
                timePicker24Hour: true,
                timePickerIncrement: 60,
                alwaysShowCalendars: true,
                showCustomRangeLabel: false,
                ranges: {
                    "За 24 часа": [moment().subtract(1, 'days'), moment()],
                    "За 7 дней": [moment().subtract(6, 'days'), moment()],
                    "За месяц": [moment().subtract(30, 'days'), moment()],
                },
                locale: {
                    format: 'YYYY.MM.DD HH:00',
                    applyLabel: "Показать",
                    cancelLabel: "Отмена",
                    fromLabel: "с",
                    toLabel: "до",
                    daysOfWeek: [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    monthNames: [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Фпрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                    "firstDay": 1
                },
                startDate: moment().startOf('day'),
                endDate: moment()
            },
            function(start, end, label) {
                var form = $('#RangeStats');
                form.find('#rangeStart').val(start.format('YYYY-MM-DD-HH'));
                form.find('#rangeEnd').val(end.format('YYYY-MM-DD-HH'));
                form.submit();
            });
        })
    </script>
@endsection
