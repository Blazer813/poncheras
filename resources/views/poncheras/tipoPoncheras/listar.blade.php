@extends('layouts.app')

@section('migas')

<div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Listar Tipos de Poncheras</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="">Tipos de Poncheras</a></li>
    </ul>
</div>

@endsection


@section('contenido')

<listar-tipoponchera-component>
</listar-tipoponchera-component>


@endsection