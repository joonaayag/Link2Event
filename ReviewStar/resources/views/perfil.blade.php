@extends('layouts.base')

@section('titulo', '- Mi Perfil')

@section('contenido')
<div class="container py-5">
    <div class="row">
        
        <!-- Contenido principal -->
        <div class="col-md-9">
            <!-- Información del perfil -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Información personal</h4>
                    <a href="{{ route('perfil.editar') }}" class="btn btn-sm btn-primary" id="editarPerfilBtn">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a>
                </div>
                <div class="card-body">
                    <!-- Muestra un mensaje de confirmación cuando se actualiza el perfil exitosamente -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Vista de información (visible por defecto) -->
                    <div id="infoView">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Nombre completo</p>
                                <h5>{{ Auth::user()->nombre }} {{ Auth::user()->apellidos }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Correo electrónico</p>
                                <h5>{{ Auth::user()->email }}</h5>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Edad</p>
                                <h5>{{ Auth::user()->edad }} años</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Nacionalidad</p>
                                <h5>{{ Auth::user()->nacionalidad }}</h5>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Tipo de identificación</p>
                                <h5>{{ Auth::user()->tipo_identificacion }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 text-muted">Número de identificación</p>
                                <h5>{{ Auth::user()->num_identificacion }}</h5>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-1 text-muted">Dirección</p>
                                <h5>{{ Auth::user()->direccion }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
