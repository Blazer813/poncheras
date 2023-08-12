@extends('layouts.emergente')


@section('contenido')

<nuevo-estadopago-component

    idestadopago = "{{ $idestadopago }}"
    evento = "{{ $evento }}"

>

</nuevo-estadopago-component>

@endsection