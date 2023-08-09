@extends('layouts.emergente')

@section('contenido')

<nuevo-estado-comoponent
    idmovimiento = "{{ $idmovimiento }}"
    evento = "{{ $evento }}"
> 
</nuevo-estado-comoponent>

@endsection