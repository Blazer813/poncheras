@extends('layouts.app')

@section('contenido')

<nuevo-movimiento-comoponent
    idmovimiento = "{{ $idmovimiento }}"
    evento = "{{ $evento }}"
> 
</nuevo-movimiento-comoponent>

@endsection