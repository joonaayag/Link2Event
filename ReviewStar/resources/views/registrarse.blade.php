@extends('layouts.base')

@section('titulo', '- Registrarse')

@section('contenido')

<div class="container mt-5">
        <h2 class="text-center">Formulario de Registro</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" placeholder="Ingrese sus apellidos" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" class="form-control" id="edad" placeholder="Ingrese su edad" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo</label>
                <select class="form-control" id="sexo" required>
                    <option value="" disabled selected>Seleccione su sexo</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="femenino">Prefiero no especificarlo</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input type="text" class="form-control" id="nacionalidad" placeholder="Ingrese su nacionalidad" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea class="form-control" id="direccion" rows="3" placeholder="Ingrese su dirección" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

@endsection