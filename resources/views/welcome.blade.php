<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.bootcss.com/multiple-select/1.2.3/multiple-select.css">
    <title>Test</title>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <a class="navbar-brand" href="#">ТЗ Aviata</a>
</nav>
    <div class="container">
    <section class="content">
        <div class="row" style="margin-bottom: 20px; margin-top: 20px;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Filters</div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select  name="route" id="select" data-toggle="select">
                                        <option value="" selected disabled>Выберите направление</option>
                                        @foreach($routes as $index => $route)
                                            <option value="{{ $route->id }}">{{ $route->fly_from }} - {{$route->fly_to}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary">Применить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-sm table-bordered">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 10px;">#</th>
                        <th>Направление</th>
                        <th>Цена</th>
                        <th>Дата</th>
                    </tr>
                    </thead>
                    <tbody id="table">
                        @foreach($calendar as $index => $item)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>
                                    {{ $item->route()->first()->fly_from }}
                                    - {{ $item->route()->first()->fly_to }}
                                </td>
                                <td>{{ $item->price }}$</td>
                                <td>{{ $item->date }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
</body>
</html>
