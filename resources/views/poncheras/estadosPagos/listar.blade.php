@extends('layouts.app')

@section('migas')

<div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Listar Estados Pagos</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="">Estados Pagos</a></li>
    </ul>
</div>

@endsection


@section('contenido')

<listar-estadopago-component>
</listar-estadopago-component>


@endsection