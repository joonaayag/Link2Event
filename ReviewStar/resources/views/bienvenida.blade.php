@extends('layouts.base')
@section('titulo', '- Bienvenida')

@section('contenido')

<h3>Bienvenido/a {{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h3>

@endsection