@extends('layouts.app')

@section('contenido')

<nuevo-estado-comoponent
    idestado = "{{ $idestado }}"
    evento = "{{ $evento }}"
> 
</nuevo-estado-comoponent>

@endsection