@extends('layouts.app')

@section('styles')

@endsection


@section('migas')

<div class="app-title">
    <div>
      <h1><i class="bi bi-speedometer"></i> Panel de Control</h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
      <li class="breadcrumb-item"><a href="">Panel de Control</a></li>
    </ul>
</div>

@endsection




@section('contenido')
    <listar-panelControl-component>
    </listar-panelControl-component>
@endsection


@section('js')

@endsection