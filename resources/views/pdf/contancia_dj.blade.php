@extends('pdf.layout')

@section('content')

<div class="card px-3">
    <table>
        <tr>
            <td colspan="4">
                <h1>Declaración Jurada</h1>
            </td>
        </tr>
        <hr>
        <tr>
            <td class="bold">Razon social:</td>
            <td>{{$dj->user->person->name}}</td>
        </tr>
        <tr>
            <td class="bold">CUIT:</td>
            <td>{{$dj->user->person->cuit}}</td>
        </tr>
        <tr>
            <td class="bold">Período:</td>
            <td>{{$dj->periodo}}</td>
        </tr>
        <tr>
            <td class="bold">Rectificativa:</td>
            <td>{{$dj->rectificativa}}</td>
        </tr>
        @if ($dj->user->person->direccion)
        <tr>
            <td class="bold">Dirección:</td>
            <td>{{$dj->user->person->direccion['string']}}</td>
        </tr>
        @endif
        <tr>
            <td class="bold">Fecha de presentación:</td>
            <td>{{date("d/m/Y H:i", strtotime($dj->fecha_presentacion))}}</td>
        </tr>
    </table>
</div>

<hr>
<h2 class="mb-3">Detalle Declaración Jurada</h2>
<table class="table">
    <tr>
        <th>Derivado</th>
        <th>Precio sin impuesto</th>
        <th>Volúmen informado (m3)</th>
        <th>Percepción</th>
        <th>Sub total</th>
    </tr>

    @foreach ($dj->items as $item)
    <tr>
        <td>{{ $item->derivado->name}}</td>
        <td>$ {{ number_format($item->precio, 2, ',', '.')}}</td>
        <td>{{ $item->volumen_m3}}</td>
        <td>{{ decimalToPercentage($item->percepcion)}}</td>
        <td>$ {{ number_format($item->sub_total, 2, ',', '.')}}</td>
    </tr>
    @endforeach
    <tr style="border-top: 1.1px solid black">
        <td colSpan="3"></td>
        <td>Total Percepción</td>
        <td>
            <b>
                $ {{ number_format($dj->total_percibido, 2, ',', '.')}}
            </b>
        </td>
    </tr>
    <tr>
        <td colSpan="3"></td>
        <td>
            Gastos administrativos <small>(5%)</small>
        </td>
        <td>

            <b>$ {{ number_format($dj->gastos_adm, 2, ',', '.')}}</b>
        </td>
    </tr>
    <tr>
        <td colSpan="3"></td>
        <td>Total a pagar </td>
        <td>
            <b>$ {{ number_format($dj->total_pagar, 2, ',', '.')}}</b>
        </td>
    </tr>
</table>

@endsection
