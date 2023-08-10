@extends('layouts.emergente')

@section('contenido')

<nuevo-estado-comoponent
    idestado = "{{ $idestado }}"
    evento = "{{ $evento }}"
> 
</nuevo-estado-comoponent>

@endsection