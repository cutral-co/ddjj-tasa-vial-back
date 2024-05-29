<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>

<style>
    .bold {
        font-weight: bold;
    }

    /* Agrega más definiciones para otros pesos y estilos de la fuente Roboto */
    table {
        width: 100%
    }

    .table {
        border: 1px solid rgba(0, 0, 0, .125);
    }

    .table tr,
    .table tr th,
    .table tr td {
        border: 1px solid rgba(0, 0, 0, .125);
        font-size: 0.9rem;
    }

    .importe {
        margin-top: 16px;
        font-size: 1.2rem;
    }

    .total {
        font-weight: 500;
    }

    .final-p {
        margin-top: 15px;
        text-align: center;
        font-size: 1.5rem;
    }
</style>

<body>

    <img src="{{ public_path('assets/images/banner.webp') }}" style="width: 40%; margin-right: 50px">
    <hr>
    @yield('content')
</body>

</html>
