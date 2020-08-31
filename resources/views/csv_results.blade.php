<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>
</head>

<body>

    <div class="container">
        <div class="card bg-light col-md-12 mt-3 ml-auto mr-auto">
            <div class="card-header text-center">
                CSV Data
            </div>
            <div class="card-body text-center">

    <form class="form-horizontal" method="POST" action="{{ route('import') }}">
        {{ csrf_field() }}

        <table class="table">
            @foreach ($csv_data as $row)
                @if ($loop->first)
                    <thead class="thead-dark">
                        <tr>
                            @foreach ($row as $key => $value)
                                <th>{{ $value }}</th>
                            @endforeach
                        </tr>
                    </thead>
                @endif
                @if ($row[7] == "status")
                    @continue
                @endif
                @if ($row[7] == "FAIL")
                    <tr>
                        @foreach ($row as $key => $value)
                            <td class="alert alert-danger">{{ $value }}</td>
                        @endforeach
                    </tr>
                @else
                    <tr>
                        @foreach ($row as $key => $value)
                            <td class="alert alert-success">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endif
            @endforeach
        </table>

        <button type="submit" class="btn btn-primary">
            Send To API
        </button>
        <a href="/importExportView" type="button" class="btn btn-default">
            Go Back
        </a>
    </form>
</div>
</div>
</div>

</div>
</div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
</body>

</html>
