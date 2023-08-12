@extends('layouts.app')


@section('migas')

<div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Listar Movimientos</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="">Movimientos</a></li>
    </ul>
</div>

@endsection


@section('contenido')

<listar-movimiento-component>
</listar-movimiento-component>

@endsection