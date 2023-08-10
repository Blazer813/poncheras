@extends('layouts.emergente')

@section('contenido')

<nuevo-colaborador-component
    idcolaborador = '{{ $idcolaborador }}'
    evento = "{{ $evento }}"
>
</nuevo-colaborador-component>

@endsection