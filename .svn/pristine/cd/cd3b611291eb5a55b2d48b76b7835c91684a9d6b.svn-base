@extends('adminlte::page')
@section('title', 'Creacion de participante')

@section('content_header')
<h1>Crear Participante</h1>
@stop
@section('content')
<div class="container mt-2">

    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('participantes.index') }}"> Regresar</a>
            </div>
        </div>
    </div>

      @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
      @endif

    <form action="{{ route('participantes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Identificación:</strong>
                    <input type="text" name="identificacion" class="form-control" placeholder="Cédula del participante">
                   @error('identificacion')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                   @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombres" class="form-control" placeholder="Nombre del participante">
                   @error('nombres')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                   @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>

    </form>
</div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
